<template>
    <div
        :class="[
            $style.expander,
            {
                [$style['_hidden']]: !isOpen ,
                [$style['_changing']]: changing
            }
        ]"
    >
        <slot />
    </div>
</template>

<script>
import gsap from 'gsap'

export default {
    name: 'UiExpander',

    props: {
        isOpen: {
            type: Boolean,
            default: false
        },

        duration: {
            type: Number,
            default: 0.3
        },

        enterDelay: {
            type: Number,
            default: 0
        },

        leaveDelay: {
            type: Number,
            default: 0
        },

        ease: {
            type: String,
            default: 'power1.out'
        }
    },

    data() {
        return {
            mounted: false,
            changing: false,
            changeTimeout: false
        }
    },

    watch: {
        isOpen() {
            this.changing = true

            if (this.isOpen) {
                gsap.to(this.$el, {
                    duration: this.duration,
                    delay: this.enterDelay,
                    height: 'auto',
                    ease: this.ease,
                    onComplete: () => { this.changing = false }
                })
            } else {
                gsap.to(this.$el, {
                    duration: this.duration,
                    delay: this.leaveDelay,
                    height: 0,
                    ease: this.ease,
                    onComplete: () => { this.changing = false }
                })
            }
        }
    },

    mounted() {
        this.$el.style.height = this.isOpen ? 'auto' : 0
    }
}
</script>

<style lang="sass" module>
.expander
    &._changing,
    &._hidden
        overflow: hidden
</style>
