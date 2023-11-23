@props(['current_page' => '', 'new_users' => [], 'categories' => []])
<!-- Create modal -->
<div id="create_entry_model" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add New {{ $current_page === 'users' ? 'User' : '' }}
                        {{ $current_page === 'tenants' ? 'Tenant' : ''}}
                        {{ $current_page === 'categories' ? 'Category' : ''}}
                        {{ $current_page === 'products' ? 'Product' : ''}}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-target="create_entry_model" data-modal-toggle="create_entry_model">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="
                {{ $current_page === 'users' ? route('users.store') : '' }}
                {{ $current_page === 'tenants' ? route('tenants.store') : ''}}
                {{ $current_page === 'categories' ? route('categories.store', ['tenant_subdomain' => auth()->user()->tenant->subdomain]) : ''}}
                {{ $current_page === 'products' ? route('products.store', ['tenant_subdomain' => auth()->user()->tenant->subdomain]) : ''}}
            " method="POST">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    @if ($current_page === 'users')
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input required type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type username">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input required type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type email">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password
                            </label>
                            <input required type="text" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type password">
                        </div>
                        <div>
                            <label for="user_role_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User role</label>
                            <select name="user_role_id" id="user_role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="2">Admin</option>
                                <option value="3">Tenant</option>
                            </select>
                        </div>
                    @elseif ($current_page === 'tenants')
                        <div>
                            <label for="subdomain" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subdomain
                            </label>
                            <input required type="text" name="subdomain" id="subdomain" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type subdomain">
                        </div>
                        <div>
                            <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Users</label>
                            <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($new_users as $new_user)
                                    <option value="{{ $new_user->id }}">{{ $new_user->email }}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif ($current_page === 'categories')
                        <div class="col-span-2">
                            <label for="category_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category name
                            </label>
                            <input required type="text" name="name" id="category_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type name">
                        </div>
                    @elseif ($current_page === 'products')
                        <div>
                            <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product name
                            </label>
                            <input required type="text" name="name" id="product_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type price">
                        </div>
                        <div>
                            <label for="product_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product price
                            </label>
                            <input required type="number" name="price" id="product_price" step="any" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type quantity">
                        </div>
                        <div>
                            <label for="product_quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product quantity
                            </label>
                            <input required type="number" name="quantity" id="product_quantity" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Choose category">
                        </div>
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                            </label>
                            <select name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <div class="flex justify-end items-center">
                    <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add new {{ $current_page === 'users' ? 'User' : '' }}
                        {{ $current_page === 'tenants' ? 'Tenant' : ''}}
                        {{ $current_page === 'categories' ? 'Category' : ''}}
                        {{ $current_page === 'products' ? 'Product' : ''}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>