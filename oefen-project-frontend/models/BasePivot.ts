import { Model } from 'pinia-orm'
export default class BasePivot extends Model {
    static fields () {
        return {
            created_at: this.string(null),
            updated_at: this.string(null),
        }
    }
    declare created_at: string
    declare updated_at: string
}