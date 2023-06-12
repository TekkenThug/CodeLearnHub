<template>
    <div :class="$style.CoursesSort">
        <div class="container">
            <div :class="$style.wrapper">
                <span>Сортировать по:</span>

                <ul :class="$style.sortList">
                    <li
                        v-for="sort in sortList"
                        :key="sort.title"
                        :class="[$style.sort, { [$style['_active']]: activeSort === sort.value }]"
                        @click="changeSort(sort.value)"
                    >
                        <Icon
                            name="bi:chevron-down"
                            :class="[$style.sortIcon, { [$style['_rotate']]: desc === 'asc' && activeSort === sort.value }]"
                        />

                        {{ sort.title }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    defaultSort: {
        type: String,
        default: 'rate'
    }
})

const emit = defineEmits(['change'])

const desc = ref('desc')
const activeSort = ref(props.defaultSort)
const sortList = ref([
    {
        title: 'Рейтингу',
        value: 'rate'
    },
    {
        title: 'Количеству студентов',
        value: 'students_count'
    },
    {
        title: 'Количеству уроков',
        value: 'lessons_count'
    },
    {
        title: 'Дате создания',
        value: 'created_at'
    }
])

const changeSort = (value) => {
    if (value !== activeSort.value) {
        desc.value = 'desc'
    } else {
        desc.value = desc.value === 'asc' ? 'desc' : 'asc'
    }

    activeSort.value = value
    emit('change', { value, desc: desc.value })
}
</script>

<style lang="sass" module>
.wrapper
    display: flex
    align-items: center

    @include responsive($mobile)
        flex-direction: column
        align-items: flex-start

.sortList
    display: flex
    gap: $offset-s
    margin-left: $offset-s

    @include responsive($mobile)
        gap: $offset-xs
        margin-top: $offset-s
        margin-left: 0
        flex-wrap: wrap

.sort
    @include trans
    @include p3
    flex-shrink: 0
    font-weight: 500
    cursor: pointer
    user-select: none

    @include hover
        color: $blue-dark-card

    &._active
        color: $blue-main

        .sortIcon
            fill: $blue-main

    .sortIcon
        @include trans
        width: 12px
        height: 12px
        stroke-width: 6px
        margin-right: 3px

        &._rotate
            transform: rotate(180deg)
</style>
