<form wire:submit.prevent="createTask" class="{{ $creatingTask  ? 'opacity-50 pointer-events-none' : '' }}"
      wire:loading.class="opacity-50 pointer-events-none">
    <!-- Action Alert  -->
    @if (session()->has('success'))
        <div class="rounded-md bg-green-500 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm leading-5 font-medium text-white">
                        {{ __('Success') }}
                    </h3>
                    <div class="mt-2 text-sm leading-5 text-white">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('failed'))
        <div class="rounded-md bg-red-100 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-9v4a1 1 0 11-2 0v-4a1 1 0 112 0zm-1-4a1 1 0 011-1h.5a1 1 0 010 2h-1a1 1 0 01-1-1zM9 13a1 1 0 112 0v1a1 1 0 11-2 0v-1zm8-3a1 1 0 110 2h-1a1 1 0 110-2h1z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm leading-5 font-medium text-red-800">
                        {{ __('Error') }}
                    </h3>
                    <div class="mt-2 text-sm leading-5 text-red-700">
                        {{ session('failed') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="">

        <!-- Task group select input -->
        <div class="col-span-6 sm:col-span-4 pt-2">
           
            <x-jet-input-error for="task_group_id" class="mt-2"/>

            <select id="task_group_id" name="task_group_id" wire:model.defer="task_group_id"
                    class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select Group</option>

                @foreach ($taskGroups as $taskGroup)
                    <option value="{{ $taskGroup->id }}"
                            @if ($taskGroup->id == $task_group_id) selected="selected" @endif>
                        {{ $taskGroup->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Name input -->
        <div class="col-span-6 sm:col-span-4 pt-2">
            <x-jet-label for="name" value="{{ __('Name') }}"/>
            <x-jet-input-error for="name" class="mt-2"/>
            <x-jet-input type="text" id="name" class="mt-1 block w-full" wire:model.defer="name"/>
        </div>

        <!-- Description input -->
        <div class="col-span-6 sm:col-span-4 pt-2">
            <x-jet-label for="description" value="{{ __('Description') }}"/>
            <x-jet-input-error for="description" class="mt-2"/>
            <textarea id="description" class="form-input rounded-md shadow-sm mt-1 block w-full"
                      wire:model.defer="description"></textarea>
        </div>

        <!-- Frequency select input -->
        <div class="col-span-6 sm:col-span-4 pt-2">
            <x-jet-label for="frequency" value="{{ __('Frequency') }}"/>
            <x-jet-input-error for="frequency" class="mt-2"/>
            <select id="frequency" wire:model.defer="frequency"
                    class="form-select mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option value="" selected {{ empty($frequency) ? 'selected' : '' }}>Select a frequency</option>
                @foreach($frequencyOptions as $optionValue => $optionLabel)
                    <option
                        value="{{ $optionValue }}" {{ $optionValue == $frequency ? 'selected' : '' }}>{{ $optionLabel }}</option>
                @endforeach  
            </select>
        </div>
        
        <!-- Start date input -->
        <div class="col-span-6 sm:col-span-4 pt-2">
            <x-jet-label for="start_date" value="{{ __('Start Date') }}"/>
            <x-jet-input-error for="start_date" class="mt-2"/>
            <x-jet-input type="date" id="start_date" class="mt-1 block w-full" wire:model.defer="start_date" :min="date('Y-m-d')"/>
        </div>

        <!-- Duration input -->
        <div class="col-span-6 sm:col-span-4 pt-2">
            <x-jet-label for="duration" value="{{ __('Duration (days)') }}"/>
            <x-jet-input-error for="duration" class="mt-2"/>
            <x-jet-input type="number" id="duration" class="mt-1 block w-full" wire:model.defer="duration" min="1"/>
        </div>

        <!-- Submit button  -->
        <div class="col-span-6 sm:col-span-4 pt-4">
            <div class="flex sm:justify-start">
                <x-jet-button wire:click="createTask"
                              wire:loading.attr="disabled">
                    {{ __('Create Task') }}
                </x-jet-button>
            </div>
        </div>
    </div>
</form>
