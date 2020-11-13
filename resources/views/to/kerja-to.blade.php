@extends('layouts.app')

@section('content')
    @include('layouts.include')
    <body class="horizontal-layout horizontal-top-icon-menu 2-columns   menu-expanded" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

        <div class="app-content content">
          <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
             
    <!-- activity charts -->
    <div class="row">
        <div class="col-xl-9 col-lg-12 ">
            <div class="card">
                <div class="card-header no-border-bottom ml-1 mr-1">
                    <div class="row">
                        <div class="col-xl-6">
                            <h4 class="text-bold-400">{{$data_soal[0]->nama}}</h4>    
                            <h4 class="text-bold-400">SOAL NO. {{$no}}</h4>
                        </div>
                        <div class="col-xl-6">
                            <div class="text-right">
                                <h4 class="text-bold-400">SISA WAKTU</h4>
                                <h4 class="text-bold-400">01:30:30</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row ml-1 mr-1">
                            @foreach ($data_soal as $data_soal)
                                
                            @endforeach
                            <span class="font-medium-2 mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam blandit, enim at dictum auctor, mi sapien porttitor diam, a lacinia purus leo sed quam...</span>
                        </div>
                        <hr class="ml-1 mr-1">
                        <div class="row skin skin-square">
                            <div class="col-12 ml-1 mr-1 mt-1">
                              <fieldset>
                                <input type="radio" name="input-radio-3" id="input-radio-11">
                                <label class="ml-1" for="input-radio-11">Radio Button</label>
                              </fieldset>
                              <fieldset>
                                <input type="radio" name="input-radio-3" id="input-radio-12">
                                <label class="ml-1"  for="input-radio-12">Radio Button Checked</label>
                              </fieldset>
                              <fieldset>
                                <input type="radio" name="input-radio-3" id="input-radio-11">
                                <label class="ml-1"  for="input-radio-11">Radio Button</label>
                              </fieldset>
                              <fieldset>
                                <input type="radio" name="input-radio-3" id="input-radio-12">
                                <label class="ml-1"  for="input-radio-12">Radio Button Checked</label>
                              </fieldset>
                              <fieldset>
                                <input type="radio" name="input-radio-3" id="input-radio-12">
                                <label class="ml-1"  for="input-radio-12">Radio Button </label>
                              </fieldset>
                            </div>
                        </div>
                        {{-- <div class="height-100"></div> --}}
                    </div>
                </div>
                <hr>
               
                <div class="row ml-1 mr-1  mb-1">
                    
				    <div class="col-4">
                        <div class="text-left">
                        @if ($no > 1)
                            <a href="#" class="btn btn-info btn-min-width"><i class="ft-arrow-left"></i> Soal Sebelumnya</a>
                        @else
                            <a href="#" class="disabled btn btn-info btn-min-width"><i class="ft-arrow-left"></i> Soal Sebelumnya</a>
                        @endif
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <div class="text-center">
                            <button type="button" class="btn btn-warning btn-min-width">Ragu-Ragu</button>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-right">
                            @if ($no < 20)
                                <a href="#" class="btn btn-info btn-min-width">Soal Selanjutnya <i class="ft-arrow-right"></i></a>
                                {{-- <a href="../{{$subtes}}/{{$id+1}}" class="btn btn-info btn-min-width">Soal Selanjutnya <i class="ft-arrow-right"></i></a> --}}
                            @else
                                <a href="#" class="disabled btn btn-info btn-min-width">Soal Selanjutnya <i class="ft-arrow-right"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="col-xl-3 col-lg-12">
            <div class="card profile-card-with-cover">
                <div class="card-content">
                    <div class="col-12 text-center mt-2 mb-2">
                        <h4 class="text-bold-400">NOMOR SOAL</h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row ml-1">
                            @for ($i=1; $i<=20; $i++)
                                <a href=""  style="min-width:46px; height:46px"class="btn mb-1 mr-1 btn-secondary">{{$i}}</a>
                                {{-- <a href="../{{$subtes}}/{{$i}}"  style="min-width:46px; height:46px"class="btn mb-1 mr-1 btn-secondary">{{$i}}</a> --}}
                            @endfor
                        </div>
                    </div>
                    <div class="col-12 ml-1 mb-1">
                        <span style="min-width:80px;" class="btn btn-success font-small-4">Hijau</span><span class="ml-1 font-small-4">= Sudah dijawab</span>
                    </div>
                    <div class="col-12 ml-1 mb-1">
                        <span style="min-width:80px;" class="btn btn-warning font-small-4">Kuning</span><span class="ml-1 font-small-4">= Ragu-ragu</span>
                    </div>
                    <div class="col-12 ml-1">
                        <span style="min-width:80px;" class="btn btn-secondary font-small-4">Hitam</span><span class="ml-1 font-small-4">= Belum dijawab</span>
                    </div>
                    <hr>
                    <div class="form-group text-center mt-1">
                        <button href="#" type="submit" class="btn btn-danger">HENTIKAN UJIAN</button>
                    </div>
                </div>
            </div>
        </div>
 </div>
    
    
          
          
        </div>
    
            </div>
          </div>
        </div>
        </div>
@endsection


