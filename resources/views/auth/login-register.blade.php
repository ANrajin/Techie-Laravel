@extends('front.layouts.app')

@section('content')
    <!-- site__body -->
      <div class="site__body">
        <div class="page-header">
          <div class="page-header__container container">
            <div class="page-header__breadcrumb">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{URL::to("/")}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    My Account
                  </li>
                </ol>
              </nav>
            </div>
            <div class="page-header__title"><h1>My Account</h1></div>
          </div>
        </div>
        <div class="block">
          <div class="container">
            <div class="row">
            {{-- Login Form start --}}
              <div class="col-md-6 d-flex">
                <div class="card flex-grow-1 mb-md-0">
                  <div class="card-body">
                    <h3 class="card-title">{{ __('Login') }}</h3>
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                      <div class="form-group">
                        <label>{{ __('E-Mail Address') }}</label>
                        <input
                          type="email"
                          class="form-control @error('email') is-invalid @enderror"
                          placeholder="Enter email"
                          name="email" 
                          value="{{ old('email') }}" 
                          required 
                          autocomplete="email" 
                        />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>{{ __('Password') }}</label>
                        <input
                          type="password"
                          class="form-control @error('password') is-invalid @enderror"
                          placeholder="Password"
                          name="password"
                          required 
                          autocomplete="current-password"
                        />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </small>
                      </div>
                      <div class="form-group">
                        <div class="form-check">
                          <span class="form-check-input input-check"
                            ><span class="input-check__body"
                              ><input
                                class="input-check__input"
                                type="checkbox"
                                id="login-remember"
                                name="remember" 
                                {{ old('remember') ? 'checked' : '' }}
                              />
                              <span class="input-check__box"></span>
                              <svg
                                class="input-check__icon"
                                width="9px"
                                height="7px"
                              >
                                <use
                                  xlink:href="images/sprite.svg#check-9x7"
                                ></use>
                              </svg> </span></span
                          ><label class="form-check-label" for="login-remember"
                            >{{ __('Remember Me') }}</label
                          >
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary mt-4">
                        {{ __('Login') }}
                      </button>
                    </form>
                  </div>
                </div>
              </div>

              {{-- Register Form start --}}
              <div class="col-md-6 d-flex mt-4 mt-md-0">
                <div class="card flex-grow-1 mb-0">
                  <div class="card-body">
                    <h3 class="card-title">{{ __('Register') }}</h3>
                    <form  method="POST" action="{{ route('register') }}">
                    @csrf
                      <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input
                          type="text" 
                          class="form-control @error('register_name') is-invalid @enderror" 
                          name="register_name" value="{{ old('register_name') }}" 
                          required 
                          autocomplete="name" 
                          placeholder="Enter user name"
                        />
                        @error('register_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>{{ __('E-Mail Address') }}</label>
                        <input
                            type="email" 
                            class="form-control @error('register_email') is-invalid @enderror" 
                            name="register_email" value="{{ old('register_email') }}" 
                            required 
                            autocomplete="email"
                            placeholder="Enter email"
                        />
                        @error('register_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>{{ __('Password') }}</label>
                        <input
                          type="password"
                          class="form-control @error('register_password') is-invalid @enderror"
                          placeholder="Password"
                          name="register_password"
                          required
                          autocomplete="new-password"
                        />
                        @error('register_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>{{ __('Confirm Password') }}</label>
                        <input
                          type="password"
                          class="form-control"
                          placeholder="Password"
                          name="register_password_confirmation"" 
                          required 
                          autocomplete="new-password"
                        />
                      </div>
                      <button type="submit" class="btn btn-primary mt-4">
                        {{ __('Register') }}
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- site__body / end -->
@endsection