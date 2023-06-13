<template>
    <div :class="$style.wrapper">
        <table :class="$style.UiTable">
            <tr :class="$style.head">
                <th
                    v-for="item in head"
                    :key="item.id"
                    :class="$style.cell"
                >
                    {{ item.title }}
                </th>
            </tr>

            <tr
                v-for="(row, index) in mappedRows"
                :key="index"
                :class="[$style.row, { [$style['_hover']]: hasClickedRow }]"
                @click="hasClickedRow ? $emit('row-click', row.id) : ''"
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
    </div>
</template>

<script setup>
const emits = defineEmits(['row-click'])
const props = defineProps({
    head: {
        type: Array,
        default: () => ([])
    },

    rows: {
        type: Array,
        default: () => ([])
    },

    hasClickedRow: {
        type: Boolean,
        default: false
    }
})

const mappedRows = computed(() => {
    const orderedHead = props.head.map(item => item.key)

    return props.rows.map((row) => {
        const newRow = {}

        orderedHead.forEach((item) => {
            newRow[item] = row[item]
        })

        return newRow
    })
})
</script>

<style lang="sass" module>
.wrapper
    width: 100%
    overflow-x: auto

.UiTable
    width: 100%
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
    &._hover
        @include trans
        cursor: pointer

        @include hover
            background-color: $gray-100

    &:not(:last-child)
        border-bottom: 1px solid $gray-100

.cell
    padding: $offset-xs $offset-m
    flex-shrink: 0
    flex-grow: 0
    width: 180px
    overflow: auto
</style>
