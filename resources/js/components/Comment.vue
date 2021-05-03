<template>
    <div class="w-full">
        <div>
            <span class="font-medium text-sm">
                {{ comment.user }}
            </span>
            <p>{{ comment.content }}</p>
            <div>
                <span v-on:click="$emit('reply-clicked', comment)" class="cursor-pointer font-medium text-gray-500 text-xs">Reply</span>
            </div>
        </div>
        <div v-if="comment.children.length > 0" class="font-extralight mx-auto px-10 text-justify text-xl w-full">
            <comments :comments="comment.children"></comments>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Comment",
        props: ['comment'],
        beforeCreate: function () {
            this.$options.components.Comments = require('./Comments').default
        }
    }
</script>
