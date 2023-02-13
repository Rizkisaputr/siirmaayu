@extends('layouts.app')
@section('body')

						<!-- [ navigation menu ] end -->
						<div class="pcoded-content">
							<!-- [ breadcrumb ] start -->
							<div class="page-header card">
									<h5>Selamat Datang</h5>

<div class="card product-progress-card m-t-20">
<div class="card-block">
	<div class="row pp-main">
	<div class="col-xl-3 col-md-6">
	<div class="pp-cont">
	 <div class="row align-items-center m-b-20">
	<div class="col-auto">
	<i class="feather icon-plus-square f-32 text-mute text-c-green"></i>
	</div>
	<div class="col text-right">
	<h2 class="m-b-0 text-c-green">{{ $puskesmas }}</h2>
	</div>
	</div>
	<div class="row align-items-center m-b-15">
	<div class="col-auto">
	<p class="m-b-0 f-18">Puskesmas</p>
	</div>
	</div>
	</div>
	</div>
	<div class="col-xl-3 col-md-6">
	<div class="pp-cont">
	<div class="row align-items-center m-b-20">
	<div class="col-auto">
	<i class="feather icon-home f-32 text-c-red "></i>
	</div>
	<div class="col text-right">
	<h2 class="m-b-0 text-c-red">{{ $desa}}</h2>
	</div>
	</div>
	<div class="row align-items-center m-b-15">
	<div class="col-auto">
	<p class="m-b-0 f-18">Desa</p>
	</div>

	</div>

	</div>
	</div>
	<div class="col-xl-3 col-md-6">
	<div class="pp-cont">
	<div class="row align-items-center m-b-20">
	<div class="col-auto">
	<i class="feather icon-users f-32 text-c-yellow"></i>
	</div>
	<div class="col text-right">
	<h2 class="m-b-0 text-c-yellow">{{ $ibu }}</h2>
	</div>
	</div>
	<div class="row align-items-center m-b-15">
	<div class="col-auto">
	<p class="m-b-0 f-18">Ibu</p>
	</div>

	</div>

	</div>
	</div>
	<div class="col-xl-3 col-md-6">
	<div class="pp-cont">
	<div class="row align-items-center m-b-20">
	<div class="col-auto">
	<i class="feather icon-file f-32 text-c-blue"></i>
	</div>
	<div class="col text-right">
	<h2 class="m-b-0 text-c-blue">{{ $periksa }}</h2>
	</div>
	</div>
	<div class="row align-items-center m-b-15">
	<div class="col-auto">
	<p class="m-b-0 f-18">Periksa</p>
	</div>

	</div>

	</div>
	</div>
	</div>
</div>
</div>


                  {{--<div class="row align-items-end">
                      <div class="col-lg-8">
                          <div class="page-header-title">
                              <i class="feather icon-watch bg-c-blue"></i>
                              <div class="d-inline">
                                  <h5>Sample page</h5>
                                  <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class=" breadcrumb breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="index.html"><i class="feather icon-home"></i></a>
                                  </li>
                                  <li class="breadcrumb-item">
                                      <a href="#!">Sample page</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>--}}
              </div>
							<!-- [ breadcrumb ] end -->
							{{--
							<div class="pcoded-inner-content">
								<div class="main-body">
									<div class="page-wrapper">
										<div class="page-body">
											<!-- [ page content ] start -->
											<div class="row">
												<div class="col-sm-12">
													<div class="card">
														<div class="card-header">
															<h5>Hello card</h5>
															<div class="card-header-right">
																<ul class="list-unstyled card-option">
																	<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
																	<li><i class="feather icon-maximize full-card"></i></li>
																	<li><i class="feather icon-minus minimize-card"></i></li>
																	<li><i class="feather icon-refresh-cw reload-card"></i></li>
																	<li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>
																</ul>
															</div>
														</div>
														<div class="card-block">
															<p>
																"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
																in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
															</p>
														</div>
													</div>
												</div>
											</div>
											<!-- [ page content ] end -->
										</div>
									</div>
								</div>
							</div>
							--}}
						</div>
						<!-- [ style Customizer ] start -->
						<div id="styleSelector">
						</div>
						<!-- [ style Customizer ] end -->

@endsection
