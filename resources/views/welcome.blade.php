<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>

    <main role="main" style="margin-top: 50px;">


        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-12 mb-5">
                    <h2>Login</h2>
                    <p>Use this method to login</p>
                    <p><a class="btn btn-secondary" href="{{route('redirectToLogin')}}" role="button">Login</a></p>
                    <p>access_token : <small>{{$access_token}}</small></p>
                    <p>refresh_token : <small>{{$refresh_token}}</small></p>
                </div>

                <div class="col-md-4 mb-4">
                    <h2>Contacts List</h2>
                    <p><a class="btn btn-secondary" href="{{route('getContacts')}}" target="_blank" role="button">Show</a></p>
                </div>
                <div class="col-md-4 mb-4">
                    <h2>Company List</h2>
                    <p><a class="btn btn-secondary" href="{{route('getCompany')}}" target="_blank" role="button">Show</a></p>
                </div>
                <div class="col-md-4 mb-4">
                    <h2>Tasks List</h2>
                    <p><a class="btn btn-secondary" href="{{route('getTasks')}}" target="_blank" role="button">Show</a></p>
                </div>
                <div class="col-md-4 mb-4">
                    <h2>Projects List</h2>
                    <p><a class="btn btn-secondary" href="{{route('getProjects')}}" target="_blank" role="button">Show</a></p>
                </div>
                <div class="col-md-4 mb-4">
                    <h2>Milestones List</h2>
                    <p><a class="btn btn-secondary" href="{{route('getMilestones')}}" target="_blank" role="button">Show</a></p>
                </div>
                <div class="col-md-4 mb-4">
                    <h2>Time Tracking List</h2>
                    <p><a class="btn btn-secondary" href="{{route('getTimeTracking')}}" target="_blank" role="button">Show</a></p>
                </div>

            </div>

            <hr>

        </div> <!-- /container -->

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>
