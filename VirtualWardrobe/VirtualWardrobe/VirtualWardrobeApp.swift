import SwiftData
import SwiftUI

@main
struct VirtualWardrobeApp: App {
    var body: some Scene {
        WindowGroup {
            WardrobeView()
        }
        .modelContainer(for: ClothingItem.self)
    }
}
