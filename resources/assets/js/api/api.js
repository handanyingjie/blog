import axios from 'axios'

export function getPostList(tag_id, page, limit) {
    return axios.get('api/posts/' + tag_id +  '/' + page + '/' + limit)
}

export function getTagList() {
    return axios.get('api/tags')
}

export function getRankList() {
    return axios.get('api/read');
}

export function email(data) {
    return axios.post('api/email',data)
}

export function register(data) {
    return axios.post('api/register',data)
}

export function code(data) {
    return axios.post('api/code', data)
}