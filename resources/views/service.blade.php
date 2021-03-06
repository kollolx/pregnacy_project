@extends('layouts.main.app')

@section('stylesheets')

@endsection

@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-2 bread">Check Up</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ftco-animate">
                <div class="comment-form-wrap pt-5">
                    <h3 class="mb-5 h4 font-weight-bold">Please provide necessary information</h3>
                    <form action="/patient/service/add-stat" method="post" class="p-5 bg-light">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>You are now pregnant in week *</label>
                                    @if(isset($service->pregnancy_week))
                                    @php
                                    $now = new DateTime();
                                    $difference_in_weeks = intval(ceil($now->diff($service->created_at)->days / 7));
                                    $val = $difference_in_weeks + $service->pregnancy_week
                                    @endphp
                                    <input type="number" value="{{ $val }}" disabled class="form-control @error('pregnancy_week') is-invalid @enderror">
                                    @else
                                    <input type="number" value="{{ (optional($service)->pregnancy_week) ?  optional($service)->pregnancy_week : old('pregnancy_week') }}" name="pregnancy_week" class="form-control @error('pregnancy_week') is-invalid @enderror">
                                    @endif
                                </div>
                                @error('pregnancy_week')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                @if(!isset($service->carrying_first_child))
                                <div class="form-group">
                                    <label>Is it you are carrying it for first child</label></br>
                                    <input type="radio" id="carrying_first_child_yes" name="carrying_first_child" @if(optional($service)->carrying_first_child == 'yes')checked @endif value="yes">
                                    <label for="carrying_first_child_yes">Yes</label><br>
                                    <input type="radio" id="carrying_first_child_no" name="carrying_first_child" @if(optional($service)->carrying_first_child == 'no')checked @endif value="no">
                                    <label for="carrying_first_child_no">No</label><br>
                                </div>
                                @endif
                                @error('carrying_first_child')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="form-group">
                                    <label>Your Weight (in lbs)*</label>
                                    <input type="number" value="{{ (optional($service)->weight) ?  optional($service)->weight : old('weight') }}" name="weight" class="form-control @error('weight') is-invalid @enderror">
                                </div>
                                @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="form-group">
                                    <label>Your Blood Pressure *</label></br>
                                    <select name="bp" class="form-control @error('bp') is-invalid @enderror">
                                        <option value="<120/80">Less than 120/80</option>
                                        <option value=">120/80">More than 120/80</option>
                                        <option value=">120/80">Equivalent to 120/80</option>

                                    </select>
                                </div>
                                @error('bp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                <div class="form-group">
                                    <label>Do you have any STI like HIV, Syphilis and genital herpes? *</label></br>
                                    <input type="radio" id="have_STI" name="have_STI" @if(optional($service)->have_STI == 'yes')checked @endif name="have_STI" value="yes">
                                    <label for="have_STI_yes">Yes</label><br>
                                    <input type="radio" id="have_STI_no" name="have_STI" @if(optional($service)->have_STI == 'no')checked @endif name="have_STI" value="no">
                                    <label for="have_STI_no">No</label><br>
                                </div>
                                @error('have_STI')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="form-group">
                                    <label>Do you have hypothyroidism? *</label></br>
                                    <input type="radio" id="have_hypothyroidism" name="have_hypothyroidism" @if(optional($service)->have_hypothyroidism == 'yes')checked @endif value="yes">
                                    <label for="have_hypothyroidism_yes">Yes</label><br>
                                    <input type="radio" id="have_hypothyroidism_no" name="have_hypothyroidism" @if(optional($service)->have_hypothyroidism == 'no')checked @endif value="no">
                                    <label for="have_hypothyroidism_no">No</label><br>
                                </div>
                                @error('have_hypothyroidism')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                @if(!isset($service->have_previous_miscarriage))
                                <div class="form-group">
                                    <label>Did you have previous miscarriage? *</label></br>
                                    <input type="radio" id="have_previous_miscarriage" name="have_previous_miscarriage" @if(optional($service)->have_previous_miscarriage == 'yes')checked @endif value="yes">
                                    <label for="have_previous_miscarriage_yes">Yes</label><br>
                                    <input type="radio" id="have_previous_miscarriage_no" name="have_previous_miscarriage" @if(optional($service)->have_previous_miscarriage == 'no')checked @endif value="no">
                                    <label for="have_previous_miscarriage_no">No</label><br>
                                </div>
                                @endif
                                @error('have_previous_miscarriage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror



                                @if(!isset($service->is_carrying_twin_or_multiple))
                                <div class="form-group">
                                    <label>Do you carrying twin or multiple babies after 12 weeks? *</label></br>
                                    <input type="radio" id="is_carrying_twin_or_multiple" name="is_carrying_twin_or_multiple" @if(optional($service)->is_carrying_twin_or_multiple == 'yes')checked @endif value="yes">
                                    <label for="is_carrying_twin_or_multiple_yes">Yes</label><br>
                                    <input type="radio" id="is_carrying_twin_or_multiple_no" name="is_carrying_twin_or_multiple" @if(optional($service)->is_carrying_twin_or_multiple == 'no')checked @endif value="no">
                                    <label for="is_carrying_twin_or_multiple_no">No</label><br>
                                </div>
                                @endif
                                @error('is_carrying_twin_or_multiple')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                <div class="form-group">
                                    <label>Glucose After Fasting (in mg/dl)*</label>
                                    <input type="number" value="{{ (optional($service)->pregnancy_week) ?  optional($service)->glucose_after_fasting : old('glucose_after_fasting') }}" name="glucose_after_fasting" class="form-control @error('glucose_after_fasting') is-invalid @enderror">
                                </div>
                                @error('glucose_after_fasting')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="col-6">
                                @if(!isset($service->age))
                                <div class="form-group">
                                    <label>Your Age *</label>
                                    <input type="number" value="{{ (optional($service)->age) ?  optional($service)->age : old('age') }}" name="age" class="form-control @error('age') is-invalid @enderror">
                                </div>
                                @endif
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                @if(!isset($service->height))
                                <div class="form-group">
                                    <label>Your Height (in cm) *</label>
                                    <input type="number" value="{{ (optional($service)->height) ?  optional($service)->height : old('height') }}" name="height" class="form-control @error('height') is-invalid @enderror">
                                </div>
                                @endif
                                @error('height')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                @if(!isset($service->bmi))
                                <div class="form-group">
                                    <label>Your BMI (before pregnancy) *</label>
                                    <input type="text" value="{{ (optional($service)->bmi) ?  optional($service)->bmi : old('bmi') }}" name="bmi" class="form-control @error('bmi') is-invalid @enderror">
                                </div>
                                @endif
                                @error('bmi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                <div class="form-group">
                                    <label>If you are in 20 weeks or more and you have proteinuria? *</label></br>
                                    <input type="radio" id="have_proteinuria" @if(optional($service)->have_proteinuria == 'yes')checked @endif name="have_proteinuria" value="yes">
                                    <label for="have_proteinuria_yes">Yes</label><br>
                                    <input type="radio" id="have_proteinuria_no" @if(optional($service)->have_proteinuria == 'no')checked @endif name="have_proteinuria" value="no">
                                    <label for="have_proteinuria_no">No</label><br>
                                </div>
                                @error('have_proteinuria')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror



                                <div class="form-group">
                                    <label>Do you have any heart diseases? *</label></br>
                                    <input type="radio" id="have_heart_diseases" name="have_heart_diseases" @if(optional($service)->have_heart_diseases == 'yes')checked @endif value="yes">
                                    <label for="have_heart_diseases_yes">Yes</label><br>
                                    <input type="radio" id="have_heart_diseases_no" name="have_heart_diseases" @if(optional($service)->have_heart_diseases == 'no')checked @endif value="no">
                                    <label for="have_heart_diseases_no">No</label><br>
                                </div>
                                @error('have_heart_diseases')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                <div class="form-group">
                                    <label>Do you have any kidney diseases? *</label></br>
                                    <input type="radio" id="have_kidney_diseases" name="have_kidney_diseases" @if(optional($service)->have_kidney_diseases == 'yes')checked @endif value="yes">
                                    <label for="have_kidney_diseases_yes">Yes</label><br>
                                    <input type="radio" id="have_kidney_diseases_no" name="have_kidney_diseases" @if(optional($service)->have_kidney_diseases == 'no')checked @endif value="no">
                                    <label for="have_kidney_diseases_no">No</label><br>
                                </div>
                                @error('have_kidney_diseases')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                <div class="form-group">
                                    <label>Do you have Anemia? *</label></br>
                                    <input type="radio" id="have_anemia" name="have_anemia" @if(optional($service)->have_anemia == 'yes')checked @endif value="yes">
                                    <label for="have_anemia_yes">Yes</label><br>
                                    <input type="radio" id="have_anemia_no" name="have_anemia" @if(optional($service)->have_anemia == 'no')checked @endif value="no">
                                    <label for="have_anemia_no">No</label><br>
                                </div>
                                @error('have_anemia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                @if(!isset($service->have_previous_cs))
                                <div class="form-group">
                                    <label>Did Previous child history in CS? *</label></br>
                                    <input type="radio" id="have_previous_cs" name="have_previous_cs" @if(optional($service)->have_previous_cs == 'yes')checked @endif value="yes">
                                    <label for="have_previous_cs_yes">Yes</label><br>
                                    <input type="radio" id="have_previous_cs_no" name="have_previous_cs" @if(optional($service)->have_previous_cs == 'no')checked @endif value="no">
                                    <label for="have_previous_cs_no">No</label><br>
                                </div>
                                @endif
                                @error('have_previous_cs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror



                                <div class="form-group">
                                    <label>Glucose Before Fasting (in mg/dl)*</label>
                                    <input type="number" value="{{ (optional($service)->pregnancy_week) ?  optional($service)->glucose_before_fasting : old('glucose_before_fasting') }}" name="glucose_before_fasting" class="form-control @error('glucose_before_fasting') is-invalid @enderror">
                                </div>
                                @error('glucose_before_fasting')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>










                        <div class="form-group">
                            <input type="submit" value="Submit" class="btn py-3 px-4 btn-primary">
                        </div>
                    </form>
                </div>
            </div> <!-- .col-md-8 -->

        </div>
    </div>
</section>

@endsection

@section('scripts')

@endsection