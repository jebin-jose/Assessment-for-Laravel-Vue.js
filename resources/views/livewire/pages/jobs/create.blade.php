<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Create new job posting</h1>
        </div>
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="fixed top-4 right-4 px-4 py-2 bg-green-500 text-white rounded shadow-lg">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="fixed top-4 right-4 px-4 py-2 bg-red-500 text-white rounded shadow-lg">
                {{ session('error') }}
            </div>
        @endif
        <form wire:submit.prevent="storeJob">
            <div class="flex flex-col lg:flex-row gap-6">

                {{-- Left Column: Job Details --}}
                <div class="w-full lg:w-2/3 bg-white rounded-xl shadow-sm p-6 border">
                    <h2 class="text-lg font-semibold mb-4">Job details</h2>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" wire:model.defer="title" placeholder="Job posting title"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200" />
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea wire:model.defer="description" placeholder="Job posting description"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 h-24 focus:outline-none focus:ring focus:ring-indigo-200"></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Experience</label>
                            <input type="text" wire:model.defer="experience" placeholder="Eg. 1-3 Yrs"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200" />
                            @error('experience')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Salary</label>
                            <input type="text" wire:model.defer="salary" placeholder="Eg. 2.75–5 Lacs PA"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200" />
                            @error('salary')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" wire:model.defer="location" placeholder="Eg. Remote / Pune"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200" />
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Extra Info</label>
                            <input type="text" wire:model.defer="extra_info"
                                placeholder="Eg. Full Time, Urgent / Part Time, Flexible"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200" />
                            <p class="text-xs text-gray-400 mt-1">Please use comma separated values</p>
                            @error('extra_info')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Right Column: Company Details --}}
                <div class="w-full lg:w-1/3 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm p-6 border">
                        <h2 class="text-lg font-semibold mb-4">Company details</h2>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" wire:model.defer="company_name" placeholder="Company Name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200" />
                            @error('company_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Logo</label>
                            <input type="file" wire:model="logo"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1.5 px-2 bg-white text-sm text-gray-700" />
                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Skills Section --}}
                    <div class="bg-white rounded-xl shadow-sm p-6 border">
                        <h2 class="text-lg font-semibold mb-4">Skills</h2>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Select Skills</label>
                            <select multiple wire:model.defer="selectedSkills"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-400 mt-1">Hold Ctrl (Windows) or Command (Mac) to select
                                multiple</p>
                            @error('selectedSkills')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 ">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
