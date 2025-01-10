@extends('admins.layouts.master')
@section('header', 'Setting')
@section('active', 'Setting')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Edit Setting</h3>
            </div>

            <div class="card-body p-0">
                <form action="{{ route('settings.update', $setting->id ?? null) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="col-12">
                            <!-- Notification Setting Text -->
                            <div class="form-group">
                                <label for="notification_setting_text">Notification Setting Text</label>
                                <textarea name="notification_setting_text" id="notification_setting_text"
                                          class="form-control"
                                          rows="5">{{ old('notification_setting_text', $setting->notification_setting_text ?? '') }}</textarea>
                            </div>

                            <!-- About App Text -->
                            <div class="form-group">
                                <label for="about_app">About App</label>
                                <textarea name="about_app" id="about_app" class="form-control"
                                          rows="5">{{ old('about_app', $setting->about_app ?? '') }}</textarea>
                            </div>

                            <!-- Phone -->
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                       value="{{ old('phone', $setting->phone ?? '') }}">
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       value="{{ old('email', $setting->email ?? '') }}">
                            </div>

                            <!-- Facebook Link -->
                            <div class="form-group">
                                <label for="f_link">Facebook Link</label>
                                <input type="text" name="f_link" id="f_link" class="form-control"
                                       value="{{ old('f_link', $setting->f_link ?? '') }}">
                            </div>

                            <!-- Twitter Link -->
                            <div class="form-group">
                                <label for="t_link">Twitter Link</label>
                                <input type="text" name="t_link" id="t_link" class="form-control"
                                       value="{{ old('t_link', $setting->t_link ?? '') }}">
                            </div>

                            <!-- Instagram Link -->
                            <div class="form-group">
                                <label for="ins_link">Instagram Link</label>
                                <input type="text" name="ins_link" id="ins_link" class="form-control"
                                       value="{{ old('ins_link', $setting->ins_link ?? '') }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
