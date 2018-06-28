import axios from 'axios'

export function getPostList(tag_id) {
    return axios.get('api/posts/' + tag_id)
}

export function getTagList() {
    return axios.get('api/tags')
}

export function getRankList() {
    return axios.get('api/read');
}