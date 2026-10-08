import { reactive } from 'vue';

async function request(path, options = {}) {
    const response = await fetch(`/api${path}`, {
        headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
        ...options,
    });
    const data = await response.json().catch(() => ({}));
    if (!response.ok) {
        const error = new Error(data.message || 'Request failed');
        error.status = response.status;
        error.errors = data.errors || {};
        throw error;
    }
    return data;
}

// Services and pricing are loaded once and shared by every page.
export const content = reactive({ services: [], plans: [], projects: [], ready: false, failed: false });

let loading;
export function loadContent() {
    loading ??= Promise.all([request('/services'), request('/pricing'), request('/projects')])
        .then(([services, plans, projects]) => {
            content.projects = projects;
            content.services = services;
            content.plans = plans;
            content.ready = true;
        })
        .catch(() => {
            content.failed = true;
            loading = undefined; // allow a retry
        });
    return loading;
}

export const sendContactMessage = (payload) =>
    request('/contact', { method: 'POST', body: JSON.stringify(payload) });
