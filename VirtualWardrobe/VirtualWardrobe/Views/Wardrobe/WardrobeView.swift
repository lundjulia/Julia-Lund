import SwiftData
import SwiftUI

struct WardrobeView: View {
    @Query(sort: \ClothingItem.name) private var items: [ClothingItem]

    @State private var viewModel = WardrobeViewModel()
    @State private var isPresentingAddItem = false
    @State private var editingItem: ClothingItem?

    private let columns = [GridItem(.adaptive(minimum: 110), spacing: 12)]

    private var filteredItems: [ClothingItem] {
        items.filter(viewModel.matches)
    }

    var body: some View {
        NavigationStack {
            Group {
                if items.isEmpty {
                    EmptyStateView(
                        title: "Your wardrobe is empty",
                        message: "Add your first clothing item to get started."
                    )
                } else {
                    ScrollView {
                        LazyVGrid(columns: columns, spacing: 12) {
                            ForEach(filteredItems) { item in
                                ClothingItemCell(item: item)
                                    .onTapGesture { editingItem = item }
                            }
                        }
                        .padding()
                    }
                }
            }
            .navigationTitle("Wardrobe")
            .toolbar {
                ToolbarItem(placement: .topBarTrailing) {
                    Button {
                        isPresentingAddItem = true
                    } label: {
                        Image(systemName: "plus")
                    }
                }
                ToolbarItem(placement: .topBarLeading) {
                    Menu {
                        Button("All") { viewModel.selectedCategory = nil }
                        ForEach(Category.allCases) { category in
                            Button(category.displayName) {
                                viewModel.selectedCategory = category
                            }
                        }
                    } label: {
                        Label("Filter", systemImage: "line.3.horizontal.decrease.circle")
                    }
                }
            }
            .sheet(isPresented: $isPresentingAddItem) {
                AddEditItemView(viewModel: AddEditItemViewModel())
            }
            .sheet(item: $editingItem) { item in
                AddEditItemView(viewModel: AddEditItemViewModel(item: item))
            }
        }
    }
}
