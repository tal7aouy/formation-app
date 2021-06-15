<template>
    <button
        class="
            inline-flex
            items-center
            px-4
            py-2
            bg-indigo-100
            border border-transparent
            rounded-md
            font-semibold
            text-xs
            uppercase
            tracking-widest
            hover:bg-indigo-200
            active:bg-gray-900
            focus:outline-none
            focus:border-indigo-200
            focus:ring focus:ring-gray-300
            disabled:opacity-25
            transition
            text-green-500
        "
        @click="toggleProgress"
    >
        {{ isWatched ? "✔️" : "☐" }}
    </button>
</template>

<script>
import axios from "axios";
import { onMounted, reactive } from "vue";
export default {
    props: ["episodeId", "watchedEpisodes"],
    data() {
        return {
            watchedEp: this.watchedEpisodes,
            isWatched: null,
        };
    },
    methods: {
        toggleProgress() {
            axios
                .post("/togglepro", {
                    episodeId: this.episodeId,
                })
                .then((resp) => {
                    if (resp.status === 200) {
                        this.isWatched = !this.isWatched;
                        this.emitter.emit("toggleProgress", resp.data);
                    }
                })
                .catch((err) => console.log(err));
        },
        isWatchedEpisode() {
            return this.watchedEp.find((item) => item.id === this.episodeId)
                ? true
                : false;
        },
    },
    mounted() {
        this.isWatched = this.isWatchedEpisode();
    },
};
</script>

<style></style>
