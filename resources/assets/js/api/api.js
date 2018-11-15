import axios from 'axios'
// axios.defaults.withCredentials=true;
export function getPostList(tag_id, page, limit) {
    return axios.get('api/posts/' + tag_id + '/' + page + '/' + limit);
}

export function getTagList() {
    return axios.get('api/tags');
}

export function getRankList() {
    return axios.get('api/read');
}

export function email(data) {
    return axios.post('api/email', data);
}

export function register(data) {
    return axios.post('api/register', data);
}

export function login(data) {
    return axios.post('api/login', data);
}

export function user() {
    return axios.get('api/user');
}

export function createReply(data) {
    return axios.post('api/reply/store',data);
}
export function getRelies(post_id) {
    return axios.get('api/reply/' + post_id);
}