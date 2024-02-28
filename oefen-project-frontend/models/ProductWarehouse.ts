
import BasePivot from "~/models/BasePivot";
import Product from "~/models/Product";
import Warehouse from "~/models/Warehouse";
export default class ProductWarehouse extends BasePivot {
    static entity = 'productWarehouse'

    $primaryKey(): string | string[] {
        return [
            'product_id',
            'warehouse_id',
        ]
    }

    static fields() {
        return {
            ...BasePivot.fields(),
            product_id: this.number(null),
            product: this.belongsTo(Product, 'product_id'),
            warehouse_id: this.number(null),
            warehouse: this.belongsTo(Warehouse, 'warehouse_id'),
            stock: this.number(null),
        }
    }

    declare name: string
}