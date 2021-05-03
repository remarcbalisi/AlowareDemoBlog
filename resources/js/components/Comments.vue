<template>
    <div class="w-full">
        <div v-for="comment in comments" :key="comment.id" class="font-extralight mx-auto py-5 text-justify text-xl">
            <comment :comment="comment"></comment>
        </div>
    </div>
</template>

<script>
    import Comment from "./Comment";

    export default {
        name: "Comments",
        props: ['comments'],
        components: {Comment}
    }
</script>
