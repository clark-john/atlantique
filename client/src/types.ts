import type { field } from 'svelte-forms';

export type WritableStringField = ReturnType<typeof field<string | Blob>>;

export interface Blog {
	id: number, 
	title: string,
	content: string,
	category: string,
	created_at: string,
	tags: string
};
