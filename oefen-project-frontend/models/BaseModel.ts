import { Model } from 'pinia-orm'
export default class BaseModel extends Model {
    static fields () {
        return {
            id: this.number(null),
            created_at: this.string(null),
            updated_at: this.string(null),
        }
    }
    declare id: string
    declare created_at: string
    declare updated_at: string
}