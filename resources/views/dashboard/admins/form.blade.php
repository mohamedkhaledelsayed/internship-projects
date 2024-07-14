<!-- begin :: Row -->
<div class="row mb-8">
    <!-- begin :: Column -->
    <div class="col-md-6 fv-row">
        <label class="fs-5 fw-bold mb-2 required">{{ __('admin.Name') }}</label>
        <div class="form-floating">
            <input type="text" class="form-control" id="name_inp" name="name" value="{{ old('name', $admin) }}"
                autocomplete="off" />
            <label for="name_inp">{{ __('admin.Enter-the') }} {{ __('admin.Name') }}</label>
            <p class="invalid-feedback" id="name"></p>
        </div>

    </div><!-- end   :: Column -->
    <!-- begin :: Column -->
    <div class="col-md-6 fv-row">
        <label class="fs-5 fw-bold mb-2 required">{{ __('admin.Email') }}</label>
        <div class="form-floating">
            <input type="email" class="form-control" id="email_inp" name="email" value="{{ old('email', $admin) }}"
                autocomplete="off" />
            <label for="email_inp">{{ __('admin.Enter-the') }} {{ __('admin.Email') }}</label>
            <p class="invalid-feedback" id="email"></p>
        </div>

    </div><!-- end   :: Column -->
</div><!-- end   :: Row -->

<!-- begin :: Row -->
<div class="row mb-8">
    <!-- begin :: Column -->
    <div class="col-md-6 fv-row">
        <label class="fs-5 fw-bold mb-2 required">{{ __('admin.Phone') }}</label>
        <div class="form-floating">
            <input type="tel" class="form-control" id="phone_inp" name="phone" value="{{ old('phone', $admin) }}"
                autocomplete="off" />
            <label for="phone_inp">{{ __('admin.Enter-the') }} {{ __('admin.Phone') }}</label>
            <p class="invalid-feedback" id="phone"></p>
        </div>

    </div><!-- end   :: Column -->
    <!-- begin :: Column -->
    <div class="col-md-6 fv-row">
        <label class="fs-5 fw-bold mb-2 required">{{ __('admin.Roles') }}</label>
        <div class="form-floating">
            <select class="form-select form-control" id="roles_inp" name="roles[]" aria-label="{{ __('admin.please-choose') }}"
                multiple>
                <option disabled>{{ __('admin.please-choose') }} {{ __('admin.Roles') }}</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ old('roles') ? (1 == 1 ? 'selected' : '') : (in_array($role->id, $admin->roles->pluck('id')->toArray()) ? 'selected' : '') }}>
                        {{ $role->name }}</option>
                @endforeach
            </select>
            <label for="roles_inp">{{ __('admin.please-choose') }} {{ __('admin.Roles') }}</label>
        </div>
        <p class="invalid-feedback" id="roles"></p>

    </div><!-- end   :: Column -->

</div><!-- end   :: Row -->
{{-- @push('scripts')
    <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\AdminRequest') !!}
@endpush --}}
