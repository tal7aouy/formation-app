<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ course.title }}
            </h2>
        </template>

        <section
            class="mx-8 py-5 md:grid md:grid-cols-3 md:gap-4 flex flex-wrap"
        >
            <div class="mr-4">
                <!-- sidebar -->
                <ul v-for="(episode, index) in course.episodes" :key="index">
                    <li
                        class="
                            mt-3
                            hover:shadow-md
                            hover:bg-indigo-300
                            py-6
                            rounded-md
                            px-4
                            bg-indigo-100
                            font-medium
                            hover:
                            cursor-pointer
                        "
                        @click="switchVideo(index)"
                    >
                        <ProgressButton
                            :episode-id="episode.id"
                            :watched-episodes="watched"
                        />
                        &nbsp; Episode n {{ index + 1 }} - {{ episode.title }}
                    </li>
                </ul>
            </div>
            <div class="col-span-2">
                <div class="shadow-md bg-indigo-200 rounded-md flex flex-col">
                    <h3 class="text-2xl p-6 text-center font-semibold">
                        {{ course.episodes[currKey].title }}
                    </h3>
                    <iframe
                        class="object-fill w-full p-4 rounded-md h-screen"
                        :src="course.episodes[currKey].video_url"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                    <p class="text-xl font-medium text-gray-600 p-6">
                        {{ course.episodes[currKey].description }}
                    </p>
                </div>
                <div class="mt-6">
                    <progress-bar
                        :watched-episodes="watched"
                        :episodes="course.episodes"
                    />
                </div>
            </div>
        </section>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetNavLink from "@/Jetstream/NavLink";
import ProgressBar from "./ProgressBar.vue";
import ProgressButton from "./ProgressButton.vue";
import { ref } from "vue";
export default {
    components: {
        ProgressButton,
        AppLayout,
        JetNavLink,
        ProgressBar,
    },
    props: ["course", "watched"],
    setup() {
        const currKey = ref(0);

        function switchVideo(index) {
            currKey.value = index;
            // window.scrollTo({
            //     top: 0,
            //     left: 0,
            //     behavior: "smooth",
            // });
        }

        return { currKey, switchVideo };
    },
};
</script>
