@foreach ($settings as $setting)
    @if ($setting->type == 'image')
        <!-- begin :: Row -->
        <div class="row mb-8">
            <!-- begin :: Column -->
            <div class="col-md-6 fv-row">
                <label class="fs-5 fw-bold mb-2 required">{{ __('admin.'. $setting->title) }}</label>

                <div class="form-floating">
                    <input type="file" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" />
                    <label for="{{ $setting->key }}">{{ __('Enter '.$setting->title) }}</label>
                </div>
            </div><!-- end   :: Column -->

            <div class="col-md-6 fv-row settings-image">
                <img src="{{ getImage('Settings', $setting->value_en) }}" alt="" class="img-responsive">
            </div>
        </div><!-- end   :: Row -->
    @else
        <!-- begin :: Row -->
        <div class="row mb-8">
            <!-- begin :: Column -->
            @foreach (config('translatable.locales') as $locale)
            @if ($locale == 'en' || $locale == 'ar')
                <div class="col-md-6 fv-row">
                    <label class="fs-5 fw-bold mb-2 required">{{ __('admin.' . $locale . '.' . $setting->title) }}</label>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="{{ $setting->key }}[{{ $locale }}]"
                            value="{{ $setting->{'value_'.$locale} }}" autocomplete="off" />
                        <label>{{ __('admin.Enter-the') }} {{ __('admin.' . $locale . '.' . $setting->title) }}</label>
                        
                    </div>
                </div><!-- end :: Column -->
            @endif
        @endforeach


        </div><!-- end   :: Row -->
    @endif
@endforeach


@push('scripts')
    {{-- <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\UserRequest') !!} --}}
@endpush
