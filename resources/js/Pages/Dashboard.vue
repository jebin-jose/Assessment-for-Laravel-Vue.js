<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import JobCard from '@/Components/Dashboard/JobCard.vue';

defineProps({
  jobs: {
    type: Object,
    required: true,
  },
  filters: {
    type: Object,
    required: false,
  }
});
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <!-- Hero -->
    <Hero :filters="filters" />
    <!-- Job List -->
    <div class="bg-white">
      <div class="container py-5">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <JobCard v-for="job in jobs.data" :key="job.id" v-bind="job" />
        </div>
        <div class="mt-8 flex justify-center">
          <template v-for="link in jobs.links" :key="link.label">
            <component
              :is="link.url ? 'a' : 'span'"
              :href="link.url"
              v-html="link.label"
              class="px-3 py-1 mx-1 border rounded text-sm"
              :class="{
                'bg-blue-500 text-white': link.active,
                'text-gray-500': !link.active
              }"
            />
          </template>
        </div>
    
      </div>
    </div>
  </AuthenticatedLayout>
</template>