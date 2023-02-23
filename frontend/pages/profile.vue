<template>
  <section style="padding-top: 120px">
    bebra

    <table v-if="store.user">
      <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Second name</td>
        <td>Email</td>
      </tr>

      <tr>
        <td>{{ store.user.id }}</td>
        <td>{{ store.user.firstName }}</td>
        <td>{{ store.user.secondName }}</td>
        <td>{{ store.user.email }}</td>
      </tr>
    </table>

    <table v-if="serverData">
      {{ serverData }}
    </table>
  </section>
</template>

<script setup lang="ts">
import { useUserStore } from '~/stores/user'

const store = useUserStore()
const serverData = ref(null)

onMounted(() => {
  store.getUserInfo()
})

definePageMeta({
  middleware: ['auth']
})
</script>
