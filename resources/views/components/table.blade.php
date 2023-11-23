@props(['entries' => [], 'current_page' => ''])
<section>
    <div>
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form action="
                        {{ $current_page === 'users' ? route('users.index') : '' }}
                        {{ $current_page === 'tenants' ? route('tenants.index') : ''}}
                        {{ $current_page === 'categories' ? route('categories.index', ['tenant_subdomain' => auth()->user()->tenant->subdomain]) : ''}}
                        {{ $current_page === 'products' ? route('products.index', ['tenant_subdomain' => auth()->user()->tenant->subdomain]) : ''}}" 
                        class="flex items-center">
                        <label for="simple-search" class="sr-only">
                            Search by {{ $current_page === 'users' ? 'email' : '' }}
                            {{ $current_page === 'tenants' ? 'subdomain' : ''}}
                            {{ $current_page === 'categories' ? 'category name' : ''}}
                            {{ $current_page === 'products' ? 'product name' : ''}}
                        </label>
                        <div class="flex items-center w-full gap-4">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    placeholder="Search by {{ $current_page === 'users' ? 'email' : '' }}{{ $current_page === 'tenants' ? 'subdomain' : ''}}{{ $current_page === 'categories' ? 'category name' : ''}}{{ $current_page === 'products' ? 'product name' : ''}}">
                            </div>
                            <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search</button>
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" id="create_entry_model_button" data-modal-target="create_entry_model" data-modal-toggle="create_entry_model" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add New {{ $current_page === 'users' ? 'User' : '' }}
                            {{ $current_page === 'tenants' ? 'Tenant' : ''}}
                            {{ $current_page === 'categories' ? 'Category' : ''}}
                            {{ $current_page === 'products' ? 'Product' : ''}}

                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            @if ($current_page === 'users')
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-4">Username</th>
                                <th scope="col" class="px-4 py-3">Role</th>
                                <th scope="col" class="px-4 py-3">Project created</th>
                                <th scope="col" class="px-4 py-3">Subdomain</th>
                            @elseif ($current_page === 'tenants')
                                <th scope="col" class="px-4 py-4">User email</th>
                                <th scope="col" class="px-4 py-3">Subdomain</th>
                                <th scope="col" class="px-4 py-3">Database</th>
                                <th scope="col" class="px-4 py-3">Full URL</th>
                            @elseif ($current_page === 'categories')
                                <th scope="col" class="px-4 py-4">Category name</th>
                                <th scope="col" class="px-4 py-3">Product name</th>
                                <th scope="col" class="px-4 py-3">Number of products</th>
                            @elseif ($current_page === 'products')
                                <th scope="col" class="px-4 py-4">Product name</th>
                                <th scope="col" class="px-4 py-3">Category name</th>
                                <th scope="col" class="px-4 py-3">Price</th>
                                <th scope="col" class="px-4 py-3">Quantity</th>
                                <th scope="col" class="px-4 py-3">Total Price</th>
                            @endif
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entries as $key=>$entry)
                            <tr class="border-b dark:border-gray-700 hover:bg-primary-50 hover:dark:bg-gray-900">
                                @if ($current_page === 'users')
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $entry->email }}
                                    </th>
                                    <td class="px-4 py-3">
                                        {{ $entry->name }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="
                                            {{ $entry->user_role_id === 1 ? 'bg-yellow-100 text-yellow-800 text-s font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                            {{ $entry->user_role_id === 2 ? 'bg-green-100 text-green-800 text-s font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300' : '' }}
                                            {{ $entry->user_role_id === 3 ? 'bg-primary-100 text-primary-800 text-s font-medium me-2 px-2.5 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300' : '' }}
                                        ">
                                            {{ $entry->user_role->role }} 
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($entry->tenant)
                                            <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                                                <span class="flex w-2.5 h-2.5 bg-green-500 rounded-full me-1.5 flex-shrink-0"></span>
                                                Created
                                            </span>
                                        @else
                                            <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                                                <span class="flex w-2.5 h-2.5 bg-red-500 rounded-full me-1.5 flex-shrink-0"></span>
                                                Not created
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($entry->tenant)
                                            <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                                {{ $entry->tenant->subdomain }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300">
                                                <span class="w-2 h-2 me-1 bg-pink-500 rounded-full"></span>
                                                Subdomain not registered
                                            </span>
                                        @endif
                                    </td>
                                @elseif ($current_page === 'tenants')
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $entry->user->email }}
                                    </th>
                                    <td class="px-4 py-3">
                                        <span class="bg-green-100 text-green-800 text-s font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                            {{ $entry->subdomain }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                                            <span class="flex w-2.5 h-2.5 bg-green-500 rounded-full me-1.5 flex-shrink-0"></span>
                                            {{ $entry->db_name }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="bg-green-100 text-green-800 text-s font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                            {{ $entry->subdomain.'.'.config('app.url') }}
                                        </span>
                                    </td>
                                @elseif ($current_page === 'categories')
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $entry->name }}
                                    </td>
                                    @if (count($entry->products))
                                        <td class="px-4 py-3">
                                            @foreach ($entry->products as $product)
                                                <div class="mb-2">
                                                    <span class="bg-green-100 text-green-800 text-s font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                        {{ $product->name }}
                                                    </span>
                                                </div>
                                                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-3">
                                            @foreach ($entry->products as $product)
                                                <div class="mb-2">
                                                    <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                                                        <span class="flex w-2.5 h-2.5 bg-green-500 rounded-full me-1.5 flex-shrink-0"></span>
                                                        {{ $product->quantity }}
                                                    </span>
                                                </div>
                                                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                                            @endforeach
                                        </td>
                                    @else
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300">
                                                <span class="w-2 h-2 me-1 bg-pink-500 rounded-full"></span>
                                                No products
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                                                <span class="flex w-2.5 h-2.5 bg-red-500 rounded-full me-1.5 flex-shrink-0"></span>
                                                0
                                            </span>
                                        </td>
                                    @endif
                                @elseif ($current_page === 'products')
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $entry->name }}
                                    </th>
                                    <td class="px-4 py-3">
                                        <span class="bg-blue-100 text-blue-800 text-s font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                            {{ $entry->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="flex items-center text-sm font-medium text-gray-900 dark:text-white me-3">
                                            <span class="flex w-2.5 h-2.5 bg-green-500 rounded-full me-1.5 flex-shrink-0"></span>
                                            {{ $entry->price }} USD
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="bg-primary-100 text-primary-800 text-s font-medium me-2 px-2.5 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">
                                            {{ $entry->quantity }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="bg-green-100 text-green-800 text-s font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                            {{ $entry->price * $entry->quantity }} USD
                                        </span>
                                    </td>
                                @endif
                                @if ($entry->user_role_id !== 1)
                                    <td class="px-4 py-3 text-right">
                                        <button id="table-row-{{ $key }}-edit-button" data-dropdown-toggle="table-row-{{ $key }}-edit" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="table-row-{{ $key }}-edit" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm" aria-labelledby="table-row-{{ $key }}-edit-button">
                                                <li>
                                                    <button type="button" data-modal-target="update_entry_{{ $key }}_model" data-modal-toggle="update_entry_{{ $key }}_model" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                        </svg>
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" data-modal-target="delete_entry_{{ $key }}_model" data-modal-toggle="delete_entry_{{ $key }}_model" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
                                                        <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (!count($entries))
                <div class="p-5">
                    <div class="flex justify-center items-center p-10 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                          <span class="font-medium"></span> Currently, no result found!
                        </div>
                    </div>
                </div>
            @endif
            @if ($entries instanceof Illuminate\Pagination\LengthAwarePaginator)
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    <ul class="inline-flex items-stretch -space-x-px">
                        <div>
                            {{ $entries->links('pagination::tailwind') }} 
                        </div>
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</section>