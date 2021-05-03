<template>
    <div class="w-full">
        <div>
            <span class="font-medium text-sm">
                {{ comment.user }}
            </span>
            <p>{{ comment.content }}</p>
            <div>
                <span v-on:click="triggerBus(comment)" class="cursor-pointer font-medium text-gray-500 text-xs">Reply</span>
            </div>
        </div>
        <div v-if="comment.children.length > 0" class="font-extralight mx-auto px-10 text-justify text-xl w-full">
            <comments :comments="comment.children"></comments>
        </div>
    </div>
</template>

<script>
    import {EventBus} from "../event-bus";

    export default {
        name: "Comment",
        props: ['comment'],
        beforeCreate: function () {
            this.$options.components.Comments = require('./Comments').default
        },
        methods: {
            triggerBus(comment) {
                EventBus.$emit('reply-clicked', comment);
            }
        }
    }
</script>
