<template>
    <div>
        <div class="bg-gray-200 w-full rounded mr-6">
            <div
                class="
                    bg-indigo-500
                    rounded-l
                    text-white text-center
                    transition-width
                    duration-500
                "
                :style="'width:' + percent + '%'"
            >
                {{ percent }}%
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["watchedEpisodes", "episodes"],
    data() {
        return {
            watchedEpisodesData: this.watchedEpisodes,
        };
    },
    computed: {
        percent() {
            let filterEpisode = this.episodes.filter((episodeEp) => {
                return this.watchedEpisodesData.find((watchedEp) => {
                    return watchedEp.id === episodeEp.id;
                });
            });
            return Math.ceil(
                (filterEpisode.length / this.episodes.length) * 100
            );
        },
    },
    mounted() {
        this.emitter.on(
            "toggleProgress",
            (data) => (this.watchedEpisodesData = data)
        );
    },
};
</script>

<style></style>
