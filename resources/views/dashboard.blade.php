<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session()->has('error'))
                        <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 mb-4 px-4 py-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg></div>
                                <div>
                                    <p class="font-bold">{{ session()->get('error') }}</p>

                                </div>
                            </div>
                        </div>
                    @endif

                    @if (auth()->user()->role->name == 'manager')


                        <span class="text-blue-500 font-bold text-xl">Received Applications</span>
                        <!-- component -->
                        <!-- component -->
                        <!-- This is an example component -->

                        @foreach ($applications as $application)
                            <div class='mt-5'>
                                <div class="rounded-xl border p-5 shadow-md w-9/12 bg-white">
                                    <div class="flex w-full items-center justify-between border-b pb-3">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]">
                                            </div>
                                            <div class="text-lg font-bold text-slate-700">{{ $application->user->name }}
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-8">
                                            <button
                                                class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">
                                                № {{ $application->id }}
                                            </button>
                                            <div class="text-xs text-neutral-500">{{ $application->created_at }}</div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div>
                                            <div class="mt-4 mb-6">
                                                <div class="mb-3 text-xl font-bold">{{ $application->subject }}</div>
                                                <div class="text-sm text-neutral-600">{{ $application->message }}</div>
                                            </div>

                                            <div>
                                                <div class="flex items-center justify-between text-slate-500">
                                                    <div class="flex space-x-4 md:space-x-8 mb-3">
                                                        {{ $application->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border p-8 m-6 hover:bg-gray-50 cursor-pointer flex flex-col">
                                            @if (is_null($application->file_url))
                                                <a href="" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>

                                                </a>
                                            @else
                                                <a href="{{ asset('storage/' . $application->file_url) }}" target="blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        {{ $applications->links() }}
                    @else
                        <div class='flex items-center '>
                            <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
                                <div class='max-w-md mx-auto space-y-6'>

                                    <form action="{{ route('applications.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <h2 class="text-2xl font-bold ">Submit your application</h2>

                                        <hr class="my-6">
                                        <label class="uppercase text-sm font-bold opacity-70">Subject</label>
                                        <input type="text" name="subject" required
                                            class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
                                        <label class="uppercase text-sm font-bold opacity-70">Message</label>
                                        <textarea rows="5" name="message" class="mt-2 mb-4 w-full bg-slate-200 rounded"> </textarea>
                                        <label class="uppercase text-sm font-bold opacity-70">File</label>
                                        <input type="file" name="file"
                                            class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
                                        <div class="my-2 font-medium opacity-70">
                                            <input type="checkbox">
                                            Subscribe and follow company updates.
                                        </div>

                                        <input type="submit"
                                            class="py-3 px-6 my-2 bg-emerald-500 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300"
                                            value="Send">

                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
