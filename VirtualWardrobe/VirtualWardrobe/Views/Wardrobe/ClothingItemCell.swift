import SwiftUI

struct ClothingItemCell: View {
    let item: ClothingItem

    private var thumbnail: Image {
        if let uiImage = ImageStore.load(fileName: item.imageFileName) {
            return Image(uiImage: uiImage)
        }
        return Image(systemName: "tshirt")
    }

    var body: some View {
        VStack(spacing: 6) {
            thumbnail
                .resizable()
                .scaledToFill()
                .frame(width: 100, height: 100)
                .clipShape(RoundedRectangle(cornerRadius: 12))
                .clipped()
            Text(item.name)
                .font(.caption)
                .lineLimit(1)
        }
    }
}
