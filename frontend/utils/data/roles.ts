const dictionary = {
    admin: 'Админ',
    student: 'Студент',
    author: 'Автор'
}

export const extractRole = (obj: { name: string }) => {
    return obj[obj.name]
}
