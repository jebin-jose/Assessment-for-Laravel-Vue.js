<template>
    <div class="bg-white rounded-xl shadow-md p-5 space-y-4">
        <div class="flex justify-between items-start">

            <img :src="logo ? `${logo}` : '/images/default-logo.png'" :alt="`${company_name} logo`"
                class="w-12 h-12 rounded-full object-cover bg-gray-100">
            <div class="ml-4 flex-1">
                <h3 class="text-lg font-semibold text-gray-800">{{ props.title }}</h3>
                <p class="text-sm text-gray-500">{{ props.company_name }}</p>
            </div>

            <div class="space-x-1">
                <span v-for="tag in props.extra_info" :key="tag"
                    class="bg-gray-200 text-xs text-gray-700 px-2 py-1 rounded">{{ tag }}</span>
            </div>
        </div>

        <div class="flex items-center text-sm text-gray-600 space-x-4">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span>{{ props.experience }}</span>
            </div>
            <span class="mx-2 text-gray-400">|</span>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ props.salary }}</span>
            </div>
            <span class="mx-2 text-gray-400">|</span>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>{{ props.location }}</span>
            </div>
        </div>

        <p class="text-sm text-gray-700 flex ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500 flex-shrink-0" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
            <span>{{ props.description }}</span>
        </p>


        <div class="flex flex-wrap gap-2">
            <span v-for="(skill, index) in props.skills" :key="skill" class="flex items-center text-xs text-gray-500">
                {{ skill.name }}
                <span v-if="index < props.skills.length - 1"
                    class="mx-2 inline-block w-1 h-1 rounded-full bg-gray-400"></span>
            </span>
        </div>

        <div class="flex justify-between items-center">
            <div class="text-xs text-gray-400">{{ props.created_at }}</div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    id: Number,
    title: String,
    company_name: String,
    extra_info: Array,
    location: String,
    experience: String,
    salary: String,
    logo: String,
    type: Array,
    description: String,
    skills: Array,
    created_at: String,
});
</script>