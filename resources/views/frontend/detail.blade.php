<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV form</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Themesdesign" />

    <link rel="icon" type="image/png" href="{{ asset('vendor/adminlte/dist/img/linn.png') }}" />

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstraps.min.css') }}" type="text/css">

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/materialdesignicons.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.css') }}" />

    <!-- selectize css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selectize.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/nice-select.css') }}" />

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>


    <!-- for signature -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css"
        rel="stylesheet">

    <style>
        @font-face {
            font-family: "MyanmarSagar";
            src: url({{ asset('fonts/custom/myanmar_sagar.ttf') }});
        }

        @charset "UTF-8";

        * {
            font-family: MyanmarSagar, sans-serif !important;
            font-size: 1rem;
            font-weight: 300;
        }

        html,
        body,
        p {
            font-family: MyanmarSagar, sans-serif !important;
            line-height: 2.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

    </style>


</head>
<script type="text/javascript">
    $(function() {
        $("#date_of_birth").datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $("#appliedate").datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $("#exp_date_from").datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $("#exp_date_to").datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $("select[name='nrc_code']").change(function() {
            var code_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('select-ajax-codes'); ?>",
                method: 'POST',
                dataType: 'html',
                data: {
                    nrc_code: code_id,
                    _token: token
                },
                success: function(data) {
                    $("select[name='nrc_state']").html(data);
                }
            });

        });


    });

</script>

<body>
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- Loader -->

    <!-- Navigation Bar-->
    <header id="topnav" class="defaultscroll scroll-active" style="background-color: #3498DB;">
        <!-- Tagline STart -->
        <div class="tagline">
            <div class="container">
                <div class="float-left">


                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Tagline End -->

        <!-- Menu Start -->
        <div class="container">
            <!-- Logo container-->
            <div>
                <a href="index.html" class="logo">
                    <img src="images/logo-light.png" alt="" class="logo-light" height="18" />
                    <img src="images/logo-dark.png" alt="" class="logo-dark" height="18" />
                </a>
            </div>
            <!--  <div class="buy-button">
                 <a href="https://shopping.linncomputer.com/"> <img src="{{ asset('uploads/images/shopping-cart.png') }}" alt="photo" width="20"> Linn OnlineShop </a>
            </div> -->
            <!--end login button-->
            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <div id="navigation" style="background-color: #3498DB;">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li><a href="{{ route('joblist.jobList') }}">Job List</a></li>
                    <!--  <li class="has-submenu">
                        <a href="javascript:void(0)">Jobs</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{ route('joblist.jobList') }}">Job List</a></li>
                           
                            <li><a href="#">Job Details</a></li>
                           
                        </ul>
                    </li> -->

                    <li class="has-submenu">
                        <a href="{{ route('frontend.jobabout') }}">About us</a>

                    </li>
                    <li>
                        <a href="{{ route('frontend.jobcontact') }}">contact</a>
                    </li>
                </ul>
                <!--end navigation menu-->
            </div>
            <!--end navigation-->
        </div>
        <!--end container-->
        <!--end end-->
    </header>
    <!--end header-->
    <!-- Navbar End -->

    <!-- Start Home -->
    <section>
        <div></div>
        <div class="home-center">

            <div class="home-form-position">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1 col-sm-12 text-center">
                        <h2 style="color:white " class="unicode" class="unicode">{{ $jobopenings->title }}</h2><br>

                    </div>

                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- end home -->

    <!-- CREATE RESUME START -->

    <section class="section">
        <form method="POST" action="{{ route('cvform.store') }}" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-dark">General Information :</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">
                            <div style="text-align: center;">
                                <input type="file" id="imgupload" name="photo" onchange="PreviewImage();"
                                    style="display: none;" />
                                <div class="next" id="file" type="file">
                                    <img id="blah" src="{{ asset('uploads/jobopeningPhoto/nophoto.png') }}"
                                        alt="your image" style="width: 90px;height: 90px;border-radius: 45px" />
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Name<span class="text-danger">*</span> :</label>
                                        <input id="first-name" type="text" name="name" class="form-control resume"
                                            placeholder="Name :">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Parent Name<span class="text-danger">*</span>
                                            :</label>
                                        <input type="text" class="form-control resume" placeholder="Parent Name :"
                                            name="pName">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Date of birth<span class="text-danger">*</span>
                                            :</label>
                                        <input type="text" class="form-control resume" placeholder="01-01-2021 :"
                                            name="dob" id="date_of_birth">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Religion<span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control resume" name="religion">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Sex<span class="text-danger">*</span> :</label>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <input type="radio" name="gender" value="male" id="gender" checked>

                                            </div>
                                            <div class="col-md-3"><label class="unicode">‌Male</label></div>
                                            <div class="col-md-1">
                                                <input type="radio" name="gender" value="female" id="gender">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="unicode">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Marital Status</label>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <input type="radio" name="marrical_status" value="marry" id="marry"
                                                    checked>

                                            </div>
                                            <div class="col-md-3"><label class="unicode">Married</label></div>
                                            <div class="col-md-1">
                                                <input type="radio" name="marrical_status" value="singal" id="singnal">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="unicode">Singal</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Email<span class="text-danger">*</span> :</label>
                                        <input type="email" class="form-control resume" placeholder="email :"
                                            name="email">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div>
                                        <label class="text-muted">NRC<span class="text-danger">*</span> :</label>
                                        <div class="row">
                                            <div class="col-md-2 {{ $errors->first('name', 'has-error') }}">

                                                <select class="form-control select2bs4 unicode" name="nrc_code"
                                                    id="code_id">
                                                    <option value="">-</option>
                                                    @foreach ($nrccodes as $nrccode)
                                                        <option value="{{ $nrccode->id }}">{{ $nrccode->name }}
                                                        </option>

                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="col-md-3 {{ $errors->first('name', 'has-error') }}">

                                                <select class="form-control unicode" name="nrc_state" id="state_id">
                                                    <option value="">-</option>
                                                    <!--  @foreach ($departments as $department) <option  value="{{ $department->id }}">{{ $department->name }}</option> @endforeach -->
                                                </select>

                                            </div>

                                            <div class="col-md-2{{ $errors->first('name', 'has-error') }}">

                                                <select name="nrc_status" id="nrc_status"
                                                    class="form-control select2bs4">
                                                    <option value="N" selected>N</option>
                                                    <option value="P">P</option>
                                                    <option value="E">E</option>
                                                    <option value="A">A</option>
                                                    <option value="F">F</option>
                                                    <option value="TH">TH</option>
                                                    <option value="G">G</option>

                                                </select>

                                            </div>
                                            <div class="col-md-2 {{ $errors->first('name', 'has-error') }}">

                                                <input type="text" name="nrc" class="form-control unicode"
                                                    placeholder="111111" id="nrc">

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <h5 class="text-dark">Contact Information :</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Phone</label>
                                        <input id="phone" type="number" class="form-control resume"
                                            placeholder="Phone No. :" name="phone">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Parent Phone</label>
                                        <input type="number" class="form-control resume"
                                            placeholder="Parent Phone No. :" name="pPhone">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">City</label>
                                        <input type="text" class="form-control resume" placeholder="City :" name="city">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Township</label>
                                        <input type="text" class="form-control resume" placeholder="Township :"
                                            name="township">
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label>Address :</label>
                                        <textarea id="address" rows="4" class="form-control resume" placeholder=""
                                            name="address"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-dark mt-5">Education Details :</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Graduation</label>
                                        <input id="graduation" type="text" class="form-control resume" placeholder=""
                                            name="graduation">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">University/College</label>
                                        <input id="university/college" type="text" class="form-control resume"
                                            placeholder="" name="education">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Degree/Certification</label>
                                        <input id="degree/certification" type="file" class="form-control resume"
                                            placeholder="" name="degree">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label class="text-muted">Level</label>
                                                <div class="form-button">
                                                    <select class="nice-select rounded" name="level">
                                                        <option data-display="Select">Select</option>
                                                        <option value="1">Level-1</option>
                                                        <option value="2">Level-2</option>
                                                        <option value="3">Level-3</option>
                                                        <option value="4">Level-4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label class="text-muted">Course Title</label>
                                                <input id="course-title" type="text" class="form-control resume"
                                                    placeholder="" name="course_title">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-5">
                        <h5 class="text-dark">Work Experience :</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Company Name</label>
                                        <input id="company-name" type="text" class="form-control resume" placeholder=""
                                            name="exp_company">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Job Position</label>
                                        <input id="job-position" type="text" class="form-control resume" placeholder=""
                                            name="exp_position">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Location</label>
                                        <input id="job-position" type="text" class="form-control resume" placeholder=""
                                            name="exp_location">

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label class="text-muted">From Date</label>
                                                <input id="exp_date_from" type="text" class="form-control resume"
                                                    placeholder="01-01-2021" name="exp_date_from">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label class="text-muted">To Date</label>
                                                <input id="exp_date_to" type="text" class="form-control resume"
                                                    placeholder="01-01-2021" name="exp_date_to">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-5">
                        <h5 class="text-dark">Employement :</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Department</label>
                                        <input id="company-name" type="text" class="form-control resume"
                                            value="{{ $jobopenings->viewDepartment->name }}" readonly>
                                        <input id="company-name" type="hidden" class="form-control resume"
                                            value="{{ $jobopenings->viewDepartment->id }}" readonly
                                            name="department">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Position</label>
                                        <input id="job-position" type="text" class="form-control resume"
                                            value="{{ $jobopenings->viewPosition->name }}" readonly>
                                        <input id="job-position" type="hidden" class="form-control resume"
                                            value="{{ $jobopenings->viewPosition->id }}" readonly name="location">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Applied Date</label>
                                        <input id="company-name" type="text" class="form-control resume"
                                            name="appliedDate" value="{{ date('d-m-Y') }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Expected Salary</label>
                                        <input id="company-name" type="text" class="form-control resume" placeholder=""
                                            name="salary">
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Hostel</label>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <input type="radio" name="isHostel" value="Yes" checked>

                                            </div>
                                            <div class="col-md-3"><label class="unicode">Yes</label></div>
                                            <div class="col-md-1">
                                                <input type="radio" name="isHostel" value="No">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="unicode">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12 mt-5">
                        <h5 class="text-dark">Skills :</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Skills</label>
                                        <input id="skills" type="text" class="form-control resume"
                                            placeholder="HTML, CSS, PHP, javascript, ..." name="skills">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Skill proficiency</label>
                                        <input id="skill_proficiency" type="text" class="form-control resume"
                                            placeholder="75%" name="proficiency">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-5">
                        <h5 class="text-dark">File Attachment :</h5>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="custom-form p-4 border rounded">

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">CV form attach file</label>
                                        <input id="degree/certification" type="file" class="form-control resume"
                                            placeholder="" name="cvfile">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Police station recommendation Photo</label>
                                        <input id="graduation" type="file" class="form-control resume" placeholder=""
                                            name="police_reco">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Ward recommendation letter Photo</label>
                                        <input id="university/college" type="file" class="form-control resume"
                                            placeholder="" name="ward_reco">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Other file</label>
                                        <input id="degree/certification" type="file" class="form-control resume"
                                            placeholder="" name="otherfile">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="col-12 mt-4">
                        <button class="btn btn-success" type="submit">Submit Resume</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- CREATE RESUME END -->





    <!-- javascript -->
    <script src="{{ asset('js/jquerys.min.js') }}"></script>
    <script src="{{ asset('js/bootstraps.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>

    <!-- selectize js -->
    <script src="{{ asset('js/selectize.min.js') }}"></script>

    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>

    <script src="{{ asset('js/apps.js') }}"></script>
    <script src="blueimp-file-upload/js/jquery.fileupload.js"></script>
    <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>


    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

</body>

</html>

<script>
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imgupload").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("blah").src = oFREvent.target.result;
        };
    };

    // $(function () {
    //   $('[data-toggle=signature]').signature()
    // })

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $(document).ready(function() {
        $(".sign").focus(function() {
            $("#myModal").modal();
        });
        $('.next').click(function() {
            $('#imgupload').trigger('click');
        });



    });


    var sig = $('#sig').signature({
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });

</script>
