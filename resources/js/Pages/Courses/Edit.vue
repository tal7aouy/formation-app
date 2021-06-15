<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update {{ course.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-green-200 text-green-500 p-3 my-4"
                    v-if="$page.props.flash.success"
                >
                    {{ $page.props.flash.success }}
                </div>
                <div class="w-full">
                    <form
                        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                        @submit.prevent="submit"
                    >
                        <div class="mb-4">
                            <label
                                class="
                                    block
                                    text-gray-700 text-sm
                                    font-bold
                                    mb-2
                                "
                                for="title"
                            >
                                Course Title
                            </label>
                            <input
                                class="
                                    shadow
                                    appearance-none
                                    border-none
                                    rounded
                                    w-full
                                    py-2
                                    px-3
                                    text-gray-700
                                    leading-tight
                                    focus:outline-none
                                    focus:shadow-outline
                                "
                                id="title"
                                type="text"
                                v-model="form.title"
                                placeholder="Course Title"
                            />
                            <div
                                class="
                                    my-3
                                    bg-red-300
                                    text-red-800
                                    p-4
                                    rounded
                                    font-medium
                                "
                                v-if="errors.title"
                            >
                                {{ errors.title }}
                            </div>
                        </div>
                        <div class="mb-4">
                            <label
                                class="
                                    block
                                    text-gray-700 text-sm
                                    font-bold
                                    mb-2
                                "
                                for="description"
                            >
                                Course Description
                            </label>
                            <textarea
                                class="
                                    shadow
                                    appearance-none
                                    border-none
                                    rounded
                                    w-full
                                    py-2
                                    px-3
                                    text-gray-700
                                    leading-tight
                                    focus:outline-none
                                    focus:shadow-outline
                                    h-20
                                "
                                id="description"
                                placeholder="Course Description ..."
                                v-model="form.description"
                            />
                            <div
                                class="
                                    my-3
                                    bg-red-300
                                    text-red-800
                                    p-4
                                    rounded
                                    font-medium
                                "
                                v-if="errors.description"
                            >
                                {{ errors.description }}
                            </div>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-2xl my-4">Episodes of Course</h2>
                            <div
                                v-for="(episode, index) in form.episodes"
                                :key="index"
                            >
                                <div class="mb-4">
                                    <label
                                        class="
                                            block
                                            text-gray-700 text-sm
                                            font-bold
                                            mb-2
                                        "
                                        :for="'title' + index"
                                    >
                                        Title of Episode n {{ index + 1 }}
                                    </label>
                                    <input
                                        class="
                                            shadow
                                            appearance-none
                                            border-none
                                            rounded
                                            w-full
                                            py-2
                                            px-3
                                            text-gray-700
                                            leading-tight
                                            focus:outline-none
                                            focus:shadow-outline
                                        "
                                        :id="'title' + index"
                                        type="text"
                                        v-model="form.episodes[index].title"
                                        placeholder="Episode title"
                                    />
                                    <div
                                        class="
                                            my-3
                                            bg-red-300
                                            text-red-800
                                            p-4
                                            rounded
                                            font-medium
                                        "
                                        v-if="
                                            errors[
                                                'episodes.' + index + '.title'
                                            ]
                                        "
                                    >
                                        {{
                                            errors[
                                                "episodes." + index + ".title"
                                            ]
                                        }}
                                    </div>
                                </div>
                                <!-- description -->
                                <div class="mb-4">
                                    <label
                                        class="
                                            block
                                            text-gray-700 text-sm
                                            font-bold
                                            mb-2
                                        "
                                        :for="'description' + index"
                                    >
                                        Description of Episode n {{ index + 1 }}
                                    </label>
                                    <input
                                        class="
                                            shadow
                                            appearance-none
                                            border-none
                                            rounded
                                            w-full
                                            py-2
                                            px-3
                                            text-gray-700
                                            leading-tight
                                            focus:outline-none
                                            focus:shadow-outline
                                        "
                                        :id="'description' + index"
                                        type="text"
                                        v-model="
                                            form.episodes[index].description
                                        "
                                        placeholder="Episode description"
                                    />
                                    <div
                                        class="
                                            my-3
                                            bg-red-300
                                            text-red-800
                                            p-4
                                            rounded
                                            font-medium
                                        "
                                        v-if="
                                            errors[
                                                'episodes.' +
                                                    index +
                                                    '.description'
                                            ]
                                        "
                                    >
                                        {{
                                            errors[
                                                "episodes." +
                                                    index +
                                                    ".description"
                                            ]
                                        }}
                                    </div>
                                </div>
                                <!-- videoUrl -->
                                <div class="mb-4">
                                    <label
                                        class="
                                            block
                                            text-gray-700 text-sm
                                            font-bold
                                            mb-2
                                        "
                                        :for="'video_url' + index"
                                    >
                                        Video url of Episode n {{ index + 1 }}
                                    </label>
                                    <input
                                        class="
                                            shadow
                                            appearance-none
                                            border-none
                                            rounded
                                            w-full
                                            py-2
                                            px-3
                                            text-gray-700
                                            leading-tight
                                            focus:outline-none
                                            focus:shadow-outline
                                        "
                                        :id="'video_url' + index"
                                        type="text"
                                        v-model="form.episodes[index].video_url"
                                        placeholder="Episode video_url"
                                    />
                                    <div
                                        class="
                                            my-3
                                            bg-red-300
                                            text-red-800
                                            p-4
                                            rounded
                                            font-medium
                                        "
                                        v-if="
                                            errors[
                                                'episodes.' +
                                                    index +
                                                    '.video_url'
                                            ]
                                        "
                                    >
                                        {{
                                            errors[
                                                "episodes." +
                                                    index +
                                                    ".video_url"
                                            ]
                                        }}
                                    </div>
                                </div>
                                <div class="border-2 border-green-600 my-4" />
                            </div>
                            <!-- end -->
                        </div>
                        <button
                            class="
                                bg-green-300
                                px-4
                                py-2
                                text-white
                                rounded
                                duration-500
                                ease-in
                                transition-all
                                hover:bg-green-500
                                mx-2
                            "
                            @click.prevent="insert"
                            v-if="form.episodes.length < 20"
                        >
                            ➕
                        </button>
                        <button
                            class="
                                bg-red-300
                                px-4
                                py-2
                                text-white
                                rounded
                                duration-500
                                ease-in
                                transition-all
                                hover:bg-red-500
                                mx-2
                            "
                            @click.prevent="remove"
                            v-if="form.episodes.length > 1"
                        >
                            🗑️
                        </button>
                        <button
                            class="
                                bg-blue-500
                                hover:bg-blue-700
                                text-white
                                font-bold
                                py-2
                                px-4
                                mx-2
                                rounded
                                focus:outline-none
                                focus:shadow-outline
                            "
                            type="submit"
                        >
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
// @ts-nocheck
import AppLayout from "@/Layouts/AppLayout";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        AppLayout,
    },
    props: {
        errors: Object,
        course: Object,
    },
    data() {
        return {
            form: this.course,
        };
    },
    methods: {
        submit() {
            Inertia.patch(`/courses/${this.form.id}`, this.form);
        },
        insert() {
            this.form.episodes.push({
                title: null,
                description: null,
                video_url: null,
            });
        },
        remove() {
            this.form.episodes.pop();
        },
    },
};
</script>
