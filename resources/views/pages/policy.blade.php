<style>
    .click_here {
        animation: blinker 1s linear infinite;

    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>
<x-guest-layout>
    <!-- Page Content -->
    <x-auth-card>
        <div class="hero-static">
            <div class="content">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8 col-xl-8">
                        <!-- Sign In Block -->
                        <div class="block block-rounded block-themed mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title text-center">Policies</h3>

                            </div>
                            <div class="block-content">


                                <div class="text-right">
                                    <!-- <x-label class="font-w400" for="terms-and-conditions" :value="__('Back to')" /> -->
                                    <a class="click_here" href="{{ route('login') }}">Login here!</a>
                                </div>
                            </div>
                        </div>
                        <!-- END Sign In Block -->
                    </div>
                </div>
            </div>
            <div class="content content-full font-size-sm text-muted text-center">
                <strong>KodeStudio.net</strong> &copy; <span data-toggle="year-copy"></span>
            </div>
        </div>
    </x-auth-card>
    <!-- END Page Content -->
</x-guest-layout>