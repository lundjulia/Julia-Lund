import Foundation
import Observation
import SwiftData
import UIKit

enum AddEditItemError: Error {
    case missingImage
}

@Observable
final class AddEditItemViewModel {
    var name: String = ""
    var category: Category = .top
    var color: String = ""
    var style: Style = .casual
    var status: Status = .active
    var newlyPickedImage: UIImage?

    private(set) var originalImage: UIImage?
    private var originalImageFileName: String?
    private let editingItem: ClothingItem?

    var isEditing: Bool { editingItem != nil }
    var displayImage: UIImage? { newlyPickedImage ?? originalImage }

    var isValid: Bool {
        !name.trimmingCharacters(in: .whitespaces).isEmpty &&
        !color.trimmingCharacters(in: .whitespaces).isEmpty &&
        displayImage != nil
    }

    init(item: ClothingItem? = nil) {
        editingItem = item
        guard let item else { return }
        name = item.name
        category = item.category
        color = item.color
        style = item.style
        status = item.status
        originalImageFileName = item.imageFileName
        originalImage = ImageStore.load(fileName: item.imageFileName)
    }

    func save(context: ModelContext) throws {
        var fileName = originalImageFileName
        if let newlyPickedImage {
            let savedFileName = try ImageStore.save(newlyPickedImage)
            if let originalImageFileName {
                ImageStore.delete(fileName: originalImageFileName)
            }
            fileName = savedFileName
        }
        guard let fileName else { throw AddEditItemError.missingImage }

        if let editingItem {
            editingItem.name = name
            editingItem.category = category
            editingItem.color = color
            editingItem.style = style
            editingItem.status = status
            editingItem.imageFileName = fileName
        } else {
            context.insert(ClothingItem(
                imageFileName: fileName,
                name: name,
                category: category,
                color: color,
                style: style,
                status: status
            ))
        }
        try context.save()
    }

    func delete(context: ModelContext) {
        guard let editingItem else { return }
        ImageStore.delete(fileName: editingItem.imageFileName)
        context.delete(editingItem)
        try? context.save()
    }
}
