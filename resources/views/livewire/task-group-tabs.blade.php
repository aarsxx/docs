<div class="w-full flex flex-col items-center justify-center">
    <div class="bg-white overflow-hidden sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="bg-white overflow-hidden  sm:rounded-lg">
                <div class="p-4 bg-white">
                    <div class="mb-4">
                        <h3 class="font-semibold text-lg pb-4 ">{{ __('All Tasks') }}</h3>
                        <hr>
                    </div>
                    <!-- Action Alert  -->
                    <div>

                        @if(empty($tasks))
                        <div class="space-y-4">
                            <div class="flex flex-col items-center justify-center h-64">
                                <p class="mt-2 text-gray-600 text-lg">
                                    No records created yet.
                                </p>
                            </div>
                            @endif

                            @foreach($tasks as $group => $groupTasks)
                                <div>
                                    <h3 class="font-semibold text-lg pb-4 pt-4">{{ $group }}</h3>
                                    <!-- Table  -->
                                    <table class="w-full min-w-full divide-y divide-gray-200">
                                        <tbody class="bg-white divide-y divide-gray-200">

                                        @foreach($groupTasks as $task)
                                            <!-- Row  -->
                                            <tr class="border-b hover:bg-gray-50 hover:text-gray-900">
                                                <!-- Column -->
                                                <td class="px-4 py-1 whitespace-nowrap text-left">
                                                    <h1 class="font-semibold font-medium ">{{ $task->name??"" }}</h1>
                                                    <p class="text-sm ring-gray-300"> {{ $task->description??"" }}</p>
                                                </td>
                                                <!-- Column -->
                                                <td class="px-4 py-1 whitespace-nowrap text-left">
                                                    <span class="p-2 inline-flex items-center px-2.5 py-0.5 rounded-md text-sm border border-indigo-400  text-indigo-700 bg-transparent hover:bg-gray-50">
                                                        {{ $task->frequency??"" }}
                                                        </span>
                                                </td>
                                                <!-- Column -->
                                                <td class="px-4 py-1 whitespace-nowrap text-left">
                                                    <span class="p-2 inline-flex items-center px-2.5 py-0.5 rounded-md text-sm border border-indigo-400  text-indigo-700 bg-transparent hover:bg-gray-50">
                                                        {{ $task->taskGroup->name??"" }}
                                                        </span>
                                                </td>
                                                <!-- Column -->
                                                <td class="px-4 py-1 whitespace-nowrap text-left">
                                                    <p class="text-sm ring-gray-300">
                                                        Due Date: {{\Carbon\Carbon::parse($task->due_date)->format('d,M,Y')}}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
