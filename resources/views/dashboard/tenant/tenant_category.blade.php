@extends('layout')

@section('content')
<div class="mt-10 max-w-screen-xl mx-auto">
    {{-- admin user management title --}}
    <div class="">
        <h2 class="text-5xl font-extrabold text-primary-500 dark:text-primary-400 flex items-center gap-5">
            <svg class="flex-shrink-0 w-10 h-10 text-primary-500 dark:text-primary-400 transition duration-75 group-hover:text-primary-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
            </svg>
            Category management
        </h2>
        <p class="my-6 text-lg text-gray-500">
            You can initiate category creation by clicking the 
            <span class="bg-primary-100 text-primary-700 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-primary-600 dark:text-primary-300">
                Add New Category
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
        <x-table :entries="$categories" :current_page="$current_page"/>
        <!-- End table -->

        {{-- Create new entry model --}}
        <x-create-entry-model :current_page="$current_page"/>

        <!-- Update modal -->
        <x-update-entry-model :entries="$categories" :current_page="$current_page"/>

        <!-- Delete modal -->
        <x-delete-entry-model :entries="$categories" :current_page="$current_page"/>
    </div>
</div>
@endsection 