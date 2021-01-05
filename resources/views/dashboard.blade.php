
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            <button style="float: right; border: 1px solid; border-radius: 3px; padding: 5px;" class="myBtn btn btn-info">Check In</button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="MyPopup" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
          
        </div>
        <div class="modal-body"></div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="yes-btn btn btn-default" >Yes</button>
              <button type="button" class="no-btn btn btn-default" >No</button>
            </div>
          </div>
          
        </div>
    </div>
</x-app-layout>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script defer src="{{asset('js/custom.js')}}"></script>