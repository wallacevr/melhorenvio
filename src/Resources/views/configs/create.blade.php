@extends('layouts.tenant', ['title' => __('MelhorEnvio Configuration')])

@section('content')
    <form action="/admin/plugins/melhorenvio/storeconfig" method="POST" id="storeSettings" enctype="multipart/form-data">
        @csrf

        <!-- Block 1 -->
        <div class="flex flex-row flex-wrap">
            <!-- header -->
            <div class="w-full md:w-1/3">
                <div class="px-4 md:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Melhor Envio Configuration') }}
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-600">
                        {{ __('You can obtain this credentials in your MelhorEnvio account.') }}
                    </p>
                </div>
            </div>

            <!-- body -->
            <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                @if (session('success'))
                    <div class="col-span-8 mx-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            <span class="font-medium">{{ session('success') }}</span> 
                    </div>

                @endif
                
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="flex flex-row flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mt-4  pr-2">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'CLIENT ID',
                                        'placeholder' => 'CLIENT ID',
                                        'name' => 'clientid',
                                        'value' => get_config('plugins/shipping/melhorenvio/clientid'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4 ">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'email',
                                        'label' => 'TECHNICAL EMAIL',
                                        'placeholder' => 'TECHNICAL EMAIL',
                                        'name' => 'technicalemail',
                                        'value' => get_config('plugins/shipping/melhorenvio/technicalemail'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4 ">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'SECRET KEY',
                                        'placeholder' => 'SECRET KEY',
                                        'name' => 'secretkey',
                                        'value' => get_config('plugins/shipping/melhorenvio/secretkey'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4 ">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'SECRET KEY',
                                        'placeholder' => 'SECRET KEY',
                                        'name' => 'secretkey',
                                        'value' => get_config('plugins/shipping/melhorenvio/secretkey'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4 ">
                                    @include('layouts.snippets.fields', [
                                        'type' => 'text',
                                        'label' => 'APP NAME',
                                        'placeholder' => 'APP NAME',
                                        'name' => 'APP_NAME',
                                        'value' => get_config('plugins/shipping/melhorenvio/appname'),
                                    ])
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <div class="mt-4 w-full">
                                        <label for="token" class="block text-sm font-medium leading-5 text-gray-700">{{__('TOKEN')}}<span class="red">*</span>
                                        </label>

                                        <div class="mt-1 w-full">
                                            <textarea id="token" name="token"  class="w-full">{{get_config('plugins/shipping/melhorenvio/token')}}</textarea>
                                        </div>

                                        @error("token")
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                </div>
                            </div>
                            <div >
                                <div class="mt-4">

                                    <label for="sandbox" class="block text-sm font-medium leading-5 text-gray-700 ">{{__('Putting your pagseguro settings under sandbox mode')}}
                                    </label> <input id="sandbox" type="checkbox" name="sandbox" value="1"
                                    @if(get_config('plugins/shipping/melhorenvio/sandbox')==1)
                                        checked
                                    @endif
                                    class="form-input block w-2.5 sm:text-sm sm:leading-5 border"  />

           
                                </div>

                            </div>

                        </div>
                        <div >


                        <div class="mx-2 my-2">
                            <button type="submit" 
                                class="py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                                {{ __('Save') }}
                            </button>
                               
                        </div>
                    </div>

                  


                </div>
            </div>
        </div>

        @include('layouts.snippets.divide')


    </form>
@endsection
@push('js')
    <script src="{{ URL::to('/') . '/js/cep-api.js' }}"></script>
    <script>
        $(document).ready(function() {
            $('#postalcode').mask('00000-000');
            $('#phone').mask('(00) 0000-0000');
            $('#whatsapp').mask('(00) 0000-0000');
            $('#taxvat').mask('00.000.000/0000-00');
            $("#storeSettings").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    postalcode: {
                        required: true,
                        minlength: 5
                    },
                    address: {
                        required: true,
                        minlength: 10
                    },
                    neighborhood: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    phone: {
                        required: true,
                        minlength: 10
                    },
                    whatsapp: {
                        required: true,
                        minlength: 10
                    },
                    facebook: {
                        url: true,
                        minlength: 10
                    },
                    youtube: {
                        url: true,
                        minlength: 10
                    },
                    instagram: {
                        url: true,
                        minlength: 10
                    },
                    pinterest: {
                        url: true,
                        minlength: 10
                    },
                    registred_company_name: {
                        required: true,
                        minlength: 10
                    },
                    company_email: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    taxvat: {
                        documentId: true
                    }
                }
            });
        });
    </script>
@endpush