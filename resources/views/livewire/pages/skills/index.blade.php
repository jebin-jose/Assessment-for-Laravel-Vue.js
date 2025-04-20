<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Skills</h1>
        </div>
        <div class="flex flex-col lg:flex-row gap-6">
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                    class="fixed top-4 right-4 px-4 py-2 bg-green-500 text-white rounded shadow-lg">
                    {{ session('message') }}
                </div>
            @endif
            <div class="w-full lg:w-2/3 bg-white rounded-xl shadow-sm p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                #</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($skills as $index => $skill)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $skill->name }}</td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <button wire:click="editSkill({{ $skill->id }})"
                                        class="text-indigo-600 hover:text-indigo-900 font-semibold transition">Edit</button>
                                    <button wire:click="deleteSkill({{ $skill->id }})"
                                        class="text-red-600 hover:text-red-800 font-semibold transition">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $skills->links() }}
                </div>
            </div>
            <div class="w-full lg:w-1/3 bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Add New Skill</h2>

                <form wire:submit.prevent="storeSkill">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" wire:model.defer="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Skill name" />
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
