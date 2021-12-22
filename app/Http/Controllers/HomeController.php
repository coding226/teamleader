<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public $client_id = 'b9eb3aa8f96768b79f5134e702d875ff';
    public $client_secret = 'b4bf82d568c311bf962d5d70e8defbab';
    public $grant_type = 'authorization_code';
    public $redirect_uri = 'http://127.0.0.1:8000/redirectFromTeamleader';
    public $response_type = 'code';

    public $access_token = '';
    public $refresh_token = '';

    //optional
    public $state = '';


    public function __construct()
    {
        $this->access_token = Cache::has('access_token') ? Cache::get('access_token') : '';
        $this->refresh_token = Cache::has('refresh_token') ? Cache::get('refresh_token') : '';
    }


    //Controller Class -------------------------------------------------------------------------------------------------------

    public function index()
    {

        return view('welcome',['access_token' => $this->access_token , 'refresh_token' => $this->refresh_token ]);
    }

    public function redirectToLogin()
    {
        return redirect('https://focus.teamleader.eu/oauth2/authorize?client_id='.$this->client_id.'&response_type='.$this->response_type.'&state='.$this->state.'&redirect_uri='.$this->redirect_uri);
    }

    public function redirectFromTeamleader()
    {
        if (\request()->has('error'))
            return [
                'error' => \request('error')
            ];

        $response = $this->getToken();

        if (isset($response['errors']))
            return [
                'errors' => $response['errors'],
                'back_url' => route('localhost')
            ];

        Cache::put('access_token', $response['access_token']);
        Cache::put('refresh_token', $response['refresh_token']);


        return redirect(route('localhost'));
    }


    public function getContactsController()
    {
        return $this->getContacts([],['size' => '20' , 'number' => '1'], [ ["field" => "added_at"] ]);
    }

    public function getCompanyController()
    {
        return $this->getCompany([],['size' => '20' , 'number' => '1'], [ ["field" => "name"] ]);
    }

    public function getTasksController()
    {
        return $this->getTasks([],['size' => '20' , 'number' => '1'], [ ["field" => "due_on"] ]);
    }

    public function getProjectsController()
    {
        return $this->getProjects([]);
    }

    public function getMilestonesController()
    {
        return $this->getMilestones([],['size' => '20' , 'number' => '1'], [ ["field" => "starts_on"] ]);
    }

    public function getTimeTrackingController()
    {
        return $this->getTimeTracking([],['size' => '20' , 'number' => '1'], [ ["field" => "starts_on"] ]);
    }


    //API Class -------------------------------------------------------------------------------------------------------
    private function getToken()
    {
        return Http::post('https://focus.teamleader.eu/oauth2/access_token', [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => \request('code'),
            'grant_type' => $this->grant_type,
            'redirect_uri' => $this->redirect_uri
        ]);
    }

    private function getRefreshToken()
    {
        return Http::post('https://focus.teamleader.eu/oauth2/access_token', [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => $this->grant_type,
            'refresh_token' => $this->refresh_token,
        ]);
    }

    private function getContacts($filter = [] , $page = [] , $sort = []){
        return $this->baseWithAuthRequest('https://api.focus.teamleader.eu/contacts.list', [
            'filter' => $filter,
            'page' => $page,
            'sort' => $sort,
        ]);
    }

    private function getCompany($filter = [] , $page = [] , $sort = []){
        return $this->baseWithAuthRequest('https://api.focus.teamleader.eu/companies.list', [
            'filter' => $filter,
            'page' => $page,
            'sort' => $sort,
        ]);
    }

    private function getTasks($filter = [] , $page = [] , $sort = []){
        return $this->baseWithAuthRequest('https://api.focus.teamleader.eu/tasks.list', [
            'filter' => $filter,
            'page' => $page,
            'sort' => $sort,
        ]);
    }

    private function getProjects($filter = []){
        return $this->baseWithAuthRequest('https://api.focus.teamleader.eu/products.list', [
            'filter' => $filter
        ]);
    }

    private function getMilestones($filter = [] , $page = [] , $sort = []){
        return $this->baseWithAuthRequest('https://api.focus.teamleader.eu/milestones.list', [
            'filter' => $filter,
            'page' => $page,
            'sort' => $sort,
        ]);
    }

    private function getTimeTracking($filter = [] , $page = [] , $sort = []){
        return $this->baseWithAuthRequest('https://api.focus.teamleader.eu/timeTracking.list', [
            'filter' => $filter,
            'page' => $page,
            'sort' => $sort,
        ]);
    }

    private function baseWithAuthRequest($url , $params){
        return Http::withToken($this->access_token)
                   ->accept('application/json')
                   ->get($url, $params);
    }
}
