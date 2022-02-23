<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Courses</h2>
    </template>

    <!-- course -->
    <div class="mt-12">
      <div
        class="
          bg-green-200
          text-green-500
          p-3
          my-4
          text-center
          w-1/2
          rounded-md
          mx-auto
        "
        v-if="$page.props.flash.success"
      >
        {{ $page.props.flash.success }}
      </div>

      <section class="flex flex-row flex-wrap mx-auto">
        <div
          class="
            transition-all
            duration-150
            flex
            w-full
            px-4
            py-6
            md:w-1/2
            lg:w-1/3
          "
          v-for="course in courses.data"
          :key="course.id"
        >
          <div
            class="
              flex flex-col
              items-stretch
              min-h-full
              pb-4
              mb-6
              transition-all
              duration-150
              bg-white
              rounded-lg
              shadow-lg
              hover:shadow-2xl
            "
          >
            <div
              class="
                flex
                items-center
                justify-between
                px-4
                py-2
                overflow-hidden
              "
            >
              <div class="flex w-full items-center justify-between">
                <div
                  class="
                    text-xs
                    font-medium
                    text-gray-500
                    flex flex-row
                    items-center
                    mr-2
                  "
                >
                  <span class="text-sm font-medium"
                    >{{ course.episodes_count }} épisodes</span
                  >
                </div>
                <span
                  class="
                    text-gray-600
                    px-3
                    py-1
                    font-semibold
                    rounded-md
                    bg-gray-200
                  "
                  >{{ convertDuration(course.t_duration) }}</span
                >
                <div class="flex justify-between">
                  <jet-nav-link
                    class="
                      bg-indigo-200
                      no-underline
                      font-semibold
                      shadow-md
                      hover:bg-indigo-300
                      rounded
                      text-white
                      mx-4
                    "
                    :href="route('courses.edit', [course.id])"
                  >
                    <i class="fas fa-pen"></i>
                  </jet-nav-link>
                  <form @submit.prevent="destroy(course.id)">
                    <button
                      class="
                        bg-indigo-200
                        no-underline
                        font-semibold
                        shadow-md
                        hover:bg-indigo-300
                        rounded
                        text-red-600
                        p-1
                      "
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <hr class="border-gray-300" />
            <div
              class="
                flex flex-wrap
                items-center
                flex-1
                px-4
                py-1
                text-center
                mx-auto
              "
            >
              <h2 class="text-2xl font-bold tracking-normal text-gray-800">
                {{ course.title }}
              </h2>
            </div>
            <hr class="border-gray-300" />
            <p
              class="
                flex flex-row flex-wrap
                w-full
                px-4
                py-2
                overflow-hidden
                text-sm text-justify text-gray-700
              "
            >
              {{ course.description }}
            </p>
            <hr class="border-gray-300" />
            <section class="px-4 py-2 mt-2">
              <div class="flex items-center justify-between">
                <div class="flex items-center justify-between flex-1">
                  <img
                    class="object-cover h-10 rounded-full"
                    src="https://thumbs.dreamstime.com/b/default-avatar-photo-placeholder-profile-icon-eps-file-easy-to-edit-default-avatar-photo-placeholder-profile-icon-124557887.jpg"
                    alt="Avatar"
                  />
                  <div class="flex flex-row mx-2">
                    <p class="font-semibold text-gray-700 hover:underline">
                      {{ course.user.name }} -
                      <span class="text-gray-500 text-sm">
                        {{ course.participants }}
                        participant<span v-if="course.participants">s</span>
                      </span>
                    </p>
                    <!-- <span class="mx-1 text-xs text-gray-600"
                                        >28 Sep 2020</span
                                    > -->
                  </div>
                  <jet-nav-link
                    :href="route('courses.show', course.id)"
                    class="
                      bg-indigo-400
                      border-none
                      rounded-md
                      font-medium
                      flex
                      justify-center
                      items-center
                      text-white
                    "
                  >
                    <svg
                      class="w-4 h-4 mr-1"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                      ></path>
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                      ></path>
                    </svg>
                    Course
                  </jet-nav-link>
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>
      <Pagination :links="courses.links" />
    </div>
  </app-layout>
</template>

<script>
// @ts-nocheck
import AppLayout from "@/Layouts/AppLayout";
import JetNavLink from "@/Jetstream/NavLink";
import { Inertia } from "@inertiajs/inertia";
import Pagination from "../../components/Pagination.vue";

export default {
  components: {
    AppLayout,
    JetNavLink,
    Pagination,
  },
  props: ["courses"],
  methods: {
    convertDuration(timestamps) {
      let hours = Math.floor(timestamps / 3600);
      let minutes = Math.floor(timestamps / 60 - hours / 60);
      let seconds = timestamps % 60;
      return (
        hours.toString().padStart(2, 0) +
        ":" +
        minutes.toString().padStart(2, 0) +
        ":" +
        seconds.toString().padStart(2, 0)
      );
    },
    destroy(id) {
      Inertia.delete(`/courses/${id}`);
    },
  },
};
</script>
