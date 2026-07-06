import Foundation
import SwiftData

@Model
final class ClothingItem: Identifiable {
    var id: UUID
    var imageFileName: String
    var name: String
    var category: Category
    var color: String
    var style: Style
    var timesUsed: Int
    var lastUsed: Date?
    var status: Status

    init(
        id: UUID = UUID(),
        imageFileName: String,
        name: String,
        category: Category,
        color: String,
        style: Style,
        timesUsed: Int = 0,
        lastUsed: Date? = nil,
        status: Status = .active
    ) {
        self.id = id
        self.imageFileName = imageFileName
        self.name = name
        self.category = category
        self.color = color
        self.style = style
        self.timesUsed = timesUsed
        self.lastUsed = lastUsed
        self.status = status
    }
}
