<template>
    <table :class="$style.UiTable">
        <tr :class="$style.head">
            <th
                v-for="item in head"
                :key="item"
                :class="$style.cell"
            >
                {{ item }}
            </th>
        </tr>

        <tr
            v-for="(row, index) in rows"
            :key="index"
            :class="$style.row"
        >
            <td
                v-for="(item, innerIndex) in Object.values(row)"
                :key="innerIndex"
                :class="$style.cell"
            >
                {{ item }}
            </td>
        </tr>
    </table>
</template>

<script setup>
const props = defineProps({
    head: {
        type: Array,
        default: () => ([])
    },

    rows: {
        type: Array,
        default: () => ([])
    }
})
</script>

<style lang="sass" module>
.UiTable
    width: 100%
    overflow-x: auto
    border-collapse: collapse
    box-shadow: 0 20px 30px rgba(48, 175, 255, 0.2)

.head
    font-weight: 600
    border-bottom: 1px solid $gray-300

.row,
.head
    display: flex
    align-items: center
    background-color: #fff
    text-align: left

.row
    &:not(:last-child)
        border-bottom: 1px solid $gray-100

.cell
    padding: $offset-xs $offset-m
    flex-shrink: 0
    flex-grow: 0
    width: 120px
    overflow: auto
</style>
