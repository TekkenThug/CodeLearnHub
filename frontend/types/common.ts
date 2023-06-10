export interface News {
    /**
     * News title
     */
    title: string,

    /**
     * News text
     */
    text: string,

    /**
     * Admin id, who is posted
     */
    admin_id?: number

    /**
     * Publication time
     */
    added_at: string,
}
