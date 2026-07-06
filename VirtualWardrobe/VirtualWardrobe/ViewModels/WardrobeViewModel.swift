import Foundation
import Observation

@Observable
final class WardrobeViewModel {
    var selectedCategory: Category?

    func matches(_ item: ClothingItem) -> Bool {
        guard let selectedCategory else { return true }
        return item.category == selectedCategory
    }
}
