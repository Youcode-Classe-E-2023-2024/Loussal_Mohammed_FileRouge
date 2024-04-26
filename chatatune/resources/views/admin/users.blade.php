<x-layouts.admin-layout title="Dashboard" >
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">

                <!-- BREADCRUMB -->
                <div class="page-meta">
                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">App</a></li>
                            <li class="breadcrumb-item"><a href="#">Blog</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
                <!-- /BREADCRUMB -->

                <div class="row layout-top-spacing">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-8">
                            <table id="blog-list" class="table dt-table-hover" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="checkbox-column"></th>
                                    <th>Users</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="no-content text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)

                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>
                                            <div class="d-flex justify-content-left align-items-center">
                                                <div class="avatar  me-3">
                                                    <img src="https://designreset.com/cork/html/src/assets/img/avatars-3.svg" alt="Avatar" width="64" height="64">
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-truncate fw-bold">{{$user->name}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{substr($user->created_at, 0, 10)}}</td>
                                        @if(!is_null($user->deleted_at))
                                            <td><span class="badge badge-danger">Archived</span></td>
                                        @else
                                            <td><span class="badge badge-success">Published</span></td>
                                        @endif
                                        <td class="text-center">

                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink4">
                                                    <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                    @unless(!is_null($user->deleted_at))
                                                        <form action="{{route('dropUser', ['user' => $user->id])}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-white hover:text-purple-900 hover:bg-indigo-600">Delete</button>
                                                        </form>
                                                    @else
                                                        <form action="{{route('restoreUser', ['user' => $user->id])}}" method="post">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item text-white hover:text-purple-900 hover:bg-indigo-600">restore</button>
                                                        </form>
                                                    @endunless
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr><td>there is no users</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!--  BEGIN FOOTER  -->
        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © <span class="dynamic-year">2022</span> <a target="_blank"
                                                                                  href="https://designreset.com/cork-admin/">DesignReset</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-heart">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                        </path>
                    </svg></p>
            </div>
        </div>
        <!--  END FOOTER  -->
    </div>

    <script>

        fetch('/api/nbrUser')
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Erreur lors de la récupération des données');
            })
            .then(data => {
                document.getElementById('nombreUtilisateurs').textContent = data.nombre_utilisateurs;
                document.getElementById('nombrePosts').textContent = data.nombre_posts;
            })
            .catch(error => {
                console.error(error);
            });



    </script>


</x-layouts.admin-layout >


