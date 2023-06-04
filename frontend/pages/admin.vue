<template>
    <div class="page">
        <div class="container">
            <div :class="$style.wrapper">
                <AdminSide
                    :class="$style.aside"
                    :active-navigation="navigation"
                    @change="value => navigation = value"
                />

                <div :class="$style.content">
                    <transition name="fade" mode="out-in">
                        <AdminUserControl
                            v-if="navigation === 'users'"
                        />
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import AdminSide from '~/components/pages/admin/AdminSide'
import AdminUserControl from '~/components/pages/admin/AdminUserControl'

const navigation = ref('users')
</script>

<style lang="sass" module>
.wrapper
    display: flex

.aside
    width: 280px
    margin-right: $offset-m

.content
    margin-left: auto
    flex-grow: 1
</style>
