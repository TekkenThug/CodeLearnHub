export const getFormattedDate = (value: string) => {
    return new Date(value).toLocaleDateString('ru-RU', {
        hour: 'numeric',
        minute: 'numeric'
    })
}

export const getArrayWithMappedDates = (
    arr: any[],
    fields: string[] = ['created_at', 'updated_at']
) => {
    return arr.map((item) => {
        const newItem = { ...item }

        fields.forEach((field) => {
            if (field in newItem) {
                newItem[field] = getFormattedDate(newItem[field])
            }
        })

        return newItem
    })
}
