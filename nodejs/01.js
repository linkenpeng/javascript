const removeArgFromUrl = (url, key) => {
    if (!url) return url
    const [path, query] = url.split('?')
    if (query) {
      const reg = new RegExp(`${key}=[^&]*\&?`, 'g')
      const queryStr = query.replace(reg, '').replace(/&$/, '')
      return `${path}${queryStr ? `?${queryStr}` : ''}`
    }
    return url
}
let jumpTimeKey = '_jumpTime'
let str = 'a/b/c?t=1&_jumpTime=123&_jumpTime[0]=xxx&_jumpTime[1]=aaa'
console.log(removeArgFromUrl(str, '_jumpTime'))
console.log(removeArgFromUrl(str, `${jumpTimeKey}\\[\\d+\\]`))