@extends('layout')

@section('content')
<div class="mt-10 max-w-screen-xl mx-auto">
    {{-- admin user management title --}}
    <div class="">
        <h2 class="text-5xl font-extrabold text-primary-500 dark:text-primary-400 flex items-center gap-5">
            <svg class="flex-shrink-0 w-10 h-10 text-primary-500 transition duration-75 dark:text-primary-400 group-hover:text-primary-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
             </svg>
            Product management
        </h2>
        <p class="my-6 text-lg text-gray-500">
            You can initiate product creation by clicking the 
            <span class="bg-primary-100 text-primary-700 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-primary-600 dark:text-primary-300">
                Add New Product
            </span> button. Subsequently, for updating or deleting records, you can execute
            these actions by selecting the ellipsis 
            <span class="bg-primary-100 text-primary-700 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-primary-600 dark:text-primary-300">
                ...
            </span> icon corresponding to each user entry in the table.
        </p>
    </div>

    <hr class="h-px my-10 bg-gray-200 border-0 dark:bg-gray-700">

    {{-- admin user management table --}}
    <div>
        <!-- Start table -->
        <x-table :entries="$products" :current_page="$current_page"/>
        <!-- End table -->

        {{-- Create new entry model --}}
        <x-create-entry-model :current_page="$current_page" :categories="$categories"/>

        <!-- Update modal -->
        <x-update-entry-model :entries="$products" :current_page="$current_page" :categories="$categories"/>

        <!-- Delete modal -->
        <x-delete-entry-model :entries="$products" :current_page="$current_page"/>
    </div>
</div>
@endsection