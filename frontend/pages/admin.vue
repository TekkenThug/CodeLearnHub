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
                        <AdminUserControl v-if="navigation === 'users'" />

                        <AdminLanguagesControl v-else-if="navigation === 'languages'" />

                        <AdminNewsControl v-else-if="navigation === 'news'" />

                        <AdminTicketControl v-else-if="navigation === 'tickets'" />
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import AdminSide from '~/components/pages/admin/AdminSide'
import AdminUserControl from '~/components/pages/admin/AdminUserControl'
import AdminNewsControl from '~/components/pages/admin/AdminNewsControl'
import AdminLanguagesControl from '~/components/pages/admin/AdminLanguagesControl'
import AdminTicketControl from '~/components/pages/admin/tickets/AdminTicketControl'

const navigation = ref('users')

definePageMeta({
    middleware: ['auth', 'admin']
})
</script>

<style lang="sass" module>
.wrapper
    display: flex

    @include responsive($mobile)
        flex-direction: column

.aside
    width: 240px
    flex-shrink: 0
    margin-right: $offset-m

    @include responsive($mobile)
        margin-right: 0
        margin-bottom: $offset-m
        width: 100%

.content
    margin-left: auto
    overflow: auto
    flex-grow: 1

    @include responsive($mobile)
        margin-left: 0
</style>
